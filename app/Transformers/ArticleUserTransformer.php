<?php

namespace App\Transformers;


use App\User;
use League\Fractal\TransformerAbstract;

class ArticleUserTransformer extends TransformerAbstract
{
    public function transform(User $model)
    {
        return [
            'id' => (int)$model->id,
            'username' => (string)$model->username,
        ];
    }
}