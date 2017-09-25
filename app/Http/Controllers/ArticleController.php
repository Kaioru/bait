<?php

namespace App\Http\Controllers;


use App\Article;
use Dingo\Api\Exception\UpdateResourceFailedException;
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

    protected function beforeStore(Request $request, Model $model)
    {
        $user = $request->user();
        $model->publisher_id = $user->id;
        $model->publisher_type = get_class($user);
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