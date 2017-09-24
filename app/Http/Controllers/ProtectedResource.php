<?php

namespace App\Http\Controllers;


use App\Team;
use App\User;
use Illuminate\Auth\AuthenticationException;

abstract class ProtectedResource extends Resource
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware('jwt.auth', ['only' => ['store', 'update', 'destroy']]);
    }

    public function validate(User $user, $publisher)
    {
        if ($publisher instanceof User) {
            if ($user->id == $publisher->id) {
                return;
            }
        } else if ($publisher instanceof Team) {
            // TODO
        }

        throw new AuthenticationException("Not allowed to act on model.");
    }
}