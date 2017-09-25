<?php

namespace App\Transformers;


use League\Fractal\TransformerAbstract;

class ArticleTeamTransformer extends TransformerAbstract
{
    public function transform(Team $model)
    {
        return [
            'id' => (int)$model->id,
            'name' => (string)$model->name,
        ];
    }
}