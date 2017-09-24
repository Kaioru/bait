<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Resource;
use App\Transformers\UserTransformer;
use App\User;

class UserController extends Resource
{

    /**
     * Eloquent model.
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    protected function model()
    {
        return new User();
    }

    /**
     * Transformer for the current model.
     *
     * @return \League\Fractal\TransformerAbstract
     */
    protected function transformer()
    {
        return new UserTransformer();
    }
}