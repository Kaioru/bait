<?php

namespace App\Transformers;


use App\Article;
use League\Fractal\TransformerAbstract;

class PublisherArticleTransformer extends TransformerAbstract
{
    public function transform(Article $model)
    {
        return [
            'id' => (int)$model->id,
            'slug' => (string)$model->slug,
            'title' => (string)$model->title,
            'body' => (string)$model->body,
            'unlisted' => (boolean)$model->unlisted
        ];
    }
}