<?php

namespace App\Transformers;


use App\Team;
use League\Fractal\TransformerAbstract;

class TeamTransformer extends TransformerAbstract
{
    public function transform(Team $model)
    {
        return [
            'id' => (int)$model->id,
            'name' => (string)$model->name,
        ];
    }
}