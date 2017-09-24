<?php

namespace App\Transformers;

use App\User;
use League\Fractal\TransformerAbstract;

class UserTransformer extends TransformerAbstract
{
    public function transform(User $model)
    {
        return [
            'id' => (int)$model->id,
            'name' => (string)$model->name,
        ];
    }
}