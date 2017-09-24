<?php

namespace App\Transformers;


use App\Page;
use League\Fractal\TransformerAbstract;

class PageTransformer extends TransformerAbstract
{
    public function transform(Page $model)
    {
        return [
            'id' => (int)$model->id,
            'title' => (string)$model->title,
            'body' => (string)$model->body,
        ];
    }
}