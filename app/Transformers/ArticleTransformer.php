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
            'title' => (string)$model->title,
            'body' => (string)$model->body,
        ];
    }

    /**
     * Include publisher
     *
     * @param Article $model
     * @return \League\Fractal\Resource\Collection|\League\Fractal\Resource\NullResource
     */
    public function includeProductions(Article $model)
    {
        $include = $model->publisher();
        return $include
            ? $this->collection($include, $include->transformer())
            : $this->null();
    }
}