<?php

namespace App\Http\Controllers;


use App\Article;
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
        $model->publisher = $request->user()->id;
        parent::beforeStore($request, $model);
    }

    protected function beforeUpdate(Request $request, Model $model)
    {
        $this->authorizeUser($request->user(), $model->publisher);
        parent::beforeUpdate($request, $model);
    }

    protected function beforeDestroy(Request $request, Model $model)
    {
        $this->authorizeUser($request->user(), $model->publisher);
        parent::beforeDestroy($request, $model);
    }
}