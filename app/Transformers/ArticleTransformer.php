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
        'stars',
    ];

    public function transform(Article $model)
    {
        return [
            'id' => (int)$model->id,
            'slug' => (string)$model->slug,
            'title' => (string)$model->title,
            'body' => (string)$model->body,
            'unlisted' => (boolean)$model->unlisted,
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
            ? $this->item($include, new ArticleUserTransformer())
            : $this->null();
    }

    /**
     * Include stars
     *
     * @param Article $model
     * @return \League\Fractal\Resource\Collection|\League\Fractal\Resource\NullResource
     */
    public function includeStars(Article $model)
    {
        $include = $model->stars;
        return $include
            ? $this->collection($include, new ArticleStarTransformer())
            : $this->null();
    }
}