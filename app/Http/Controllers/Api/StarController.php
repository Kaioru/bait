<?php

namespace App\Http\Controllers\Api;


use App\Star;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class StarController extends ProtectedResource
{
    /**
     * Eloquent model.
     *
     * @return Model
     */
    protected function model(): Model
    {
        return new Star();
    }

    public function index()
    {
        $this->response->errorForbidden();
    }

    protected function beforeStore(Request $request, Model $model)
    {
        $user = $request->user();
        $article = $model->article;

        if ($user->stars->contains('article_id', $article->id)) {
            $this->response->errorForbidden('already_starred');
        }

        $model->user_id = $user->id;
        parent::beforeStore($request, $model);
    }

    protected function beforeUpdate(Request $request, Model $model)
    {
        $this->response->errorForbidden();
    }

    protected function beforeDestroy(Request $request, Model $model)
    {
        $this->authorizePublisher($request->user(), $model->publisher);
        parent::beforeDestroy($request, $model);
    }
}