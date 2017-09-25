<?php

namespace App\Transformers;


use App\Star;
use League\Fractal\TransformerAbstract;

class UserStarTransformer extends TransformerAbstract
{
    public function transform(Star $model)
    {
        return [
            'id' => (int)$model->id,
            'article_id' => (int)$model->article_id,
        ];
    }
}