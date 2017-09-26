<?php

namespace App\Http\Controllers\Api;


use App\Article;
use App\Team;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class ArticleController extends ProtectedResource
{

    /**
     * Eloquent model.
     *
     * @return Model
     */
    protected function model(): Model
    {
        return new Article();
    }

    public function index()
    {
        $models = $this->model
            ->where('unlisted', '=', 'false')
            ->withCount('stars')
            ->orderBy('stars_count', 'desc')
            ->paginate(15);
        $transformer = $this->transformer;
        return $this->response->paginator($models, $transformer);
    }

    protected function beforeStore(Request $request, Model $model)
    {
        $user = $request->user();
        $publisher = $user;

        if ($request->has('team')) {
            $team = $request->input('team');
            $publisher = Team::find($team);
            $this->authorizePublisher($user, $publisher);
        }

        $model->publisher_id = $publisher->id;
        $model->publisher_type = get_class($publisher);
        parent::beforeStore($request, $model);
    }

    protected function beforeUpdate(Request $request, Model $model)
    {
        $this->authorizePublisher($request->user(), $model->publisher);
        parent::beforeUpdate($request, $model);
    }

    protected function beforeDestroy(Request $request, Model $model)
    {
        $this->authorizePublisher($request->user(), $model->publisher);
        parent::beforeDestroy($request, $model);
    }
}