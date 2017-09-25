<?php

namespace App\Transformers;


use App\Star;
use League\Fractal\TransformerAbstract;

class ArticleStarTransformer extends TransformerAbstract
{
    public function transform(Star $model)
    {
        return [
            'id' => (int)$model->id,
            'user_id' => (int)$model->user_id,
        ];
    }
}