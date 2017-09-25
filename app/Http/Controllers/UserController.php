<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Resource;
use App\User;
use Illuminate\Database\Eloquent\Model;

class UserController extends Resource
{
    /**
     * Eloquent model.
     *
     * @return Model
     */
    protected function model(): Model
    {
        return new User();
    }
}