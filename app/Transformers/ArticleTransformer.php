<?php

namespace App\Transformers;

use App\Article;
use League\Fractal\TransformerAbstract;

class ArticleTransformer extends TransformerAbstract
{
    /**
     * List of resources to automatically include
     *
     * @var array
     */
    protected $defaultIncludes = [
        'publisher',
    ];

    public function transform(Article $model)
    {
        return [
            'id' => (int)$model->id,
            'slug' => (string)$model->slug,
            'title' => (string)$model->title,
            'body' => (string)$model->body,
            'publisher_type' => (string)$model->publisher_type,
        ];
    }

    /**
     * Include publisher
     *
     * @param Article $model
     * @return \League\Fractal\Resource\Item|\League\Fractal\Resource\NullResource
     */
    public function includePublisher(Article $model)
    {
        $include = $model->publisher;
        return $include
            ? $this->item($include, $include->transformer())
            : $this->null();
    }
}