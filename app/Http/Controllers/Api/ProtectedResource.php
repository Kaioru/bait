<?php

namespace App\Http\Controllers\Api;


use App\Team;
use App\User;

abstract class ProtectedResource extends Resource
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware('jwt.auth', ['only' => ['store', 'update', 'destroy']]);
    }

    public function authorizePublisher(User $user, $publisher)
    {
        if ($publisher instanceof User) {
            if ($user->id == $publisher->id) {
                return;
            }
        } else if ($publisher instanceof Team) {
            if ($publisher->users->contains('id', $user->id)) {
                return;
            }
        }

        $this->response->errorForbidden('no_permission_to_act');
    }
}