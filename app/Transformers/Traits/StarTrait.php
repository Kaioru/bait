<?php

namespace App\Transformers\Traits;


use App\Star;

trait StarTrait
{
    public function transform(Star $model)
    {
        return [
            'id' => (int)$model->id,
        ];
    }
}