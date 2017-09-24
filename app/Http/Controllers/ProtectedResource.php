<?php

namespace App\Http\Controllers;


use Dingo\Api\Exception\UpdateResourceFailedException;
use Illuminate\Http\Request;

abstract class ProtectedResource extends Resource
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware('jwt.auth', ['only' => ['store', 'update', 'destroy']]);
    }

    public function update(Request $request, $id)
    {
        $model = $this->find($id);

        if ($model->owner_id == $this->user_id) {
            parent::update($request, $id);
        } else {
            throw new UpdateResourceFailedException();
        }
    }

    public function destroy($id)
    {
        $model = $this->find($id);

        if ($model->owner_id == $this->user_id) {
            parent::destroy($id);
        } else {
            throw new UpdateResourceFailedException();
        }
    }
}