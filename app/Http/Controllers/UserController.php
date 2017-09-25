<?php

namespace App\Http\Controllers;


use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends ProtectedResource
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware('jwt.auth', ['only' => ['self', 'show', 'update', 'destroy']]);
    }

    /**
     * Eloquent model.
     *
     * @return Model
     */
    protected function model(): Model
    {
        return new User();
    }

    public function self(Request $request)
    {
        $model = $request->user();
        return $this->response->item($model, $this->transformer);
    }

    protected function beforeShow(Request $request, Model $model)
    {
        $this->authorizePublisher($request->user(), $model);
        parent::beforeShow($request, $model);
    }

    protected function beforeStore(Request $request, Model $model)
    {
        $model->password = Hash::make($model->password);
        parent::beforeStore($request, $model);
    }

    protected function beforeUpdate(Request $request, Model $model)
    {
        $this->authorizePublisher($request->user(), $model);
        parent::beforeUpdate($request, $model);
    }

    protected function beforeDestroy(Request $request, Model $model)
    {
        $this->authorizePublisher($request->user(), $model);
        parent::beforeDestroy($request, $model);
    }
}