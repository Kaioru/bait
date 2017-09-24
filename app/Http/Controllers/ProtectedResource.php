<?php

namespace App\Http\Controllers;


use Dingo\Api\Exception\DeleteResourceFailedException;
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

        if ($model->owner_id == $request->user()->id) {
            parent::update($request, $id);
        } else {
            throw new UpdateResourceFailedException('No permission to update model.');
        }
    }

    public function destroy(Request $request, $id)
    {
        $model = $this->find($id);

        if ($model->owner_id == $request->user()->id) {
            parent::destroy($request, $id);
        } else {
            throw new DeleteResourceFailedException('No permission to destroy model.');
        }
    }
}