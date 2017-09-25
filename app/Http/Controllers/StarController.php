<?php

namespace App\Http\Controllers;


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

    protected function beforeStore(Request $request, Model $model)
    {
        $model->user_id = $request->user()->id;
        parent::beforeStore($request, $model);
    }

    protected function beforeUpdate(Request $request, Model $model)
    {
        return $this->response->errorForbidden();
    }

    protected function beforeDestroy(Request $request, Model $model)
    {
        $this->authorizePublisher($request->user(), $model->publisher);
        parent::beforeDestroy($request, $model);
    }
}