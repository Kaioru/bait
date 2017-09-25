<?php

namespace App\Http\Controllers;


use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class UserController extends ProtectedResource
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware('jwt.auth', ['only' => ['update', 'destroy']]);
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