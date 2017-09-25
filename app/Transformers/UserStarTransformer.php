<?php

namespace App\Transformers;


use App\Star;
use League\Fractal\TransformerAbstract;

class UserStarTransformer extends TransformerAbstract
{
    /**
     * List of resources to automatically include
     *
     * @var array
     */
    protected $defaultIncludes = [
        'article',
    ];

    public function transform(Star $model)
    {
        return [
            'id' => (int)$model->id,
        ];
    }

    /**
     * Include user
     *
     * @param Star $model
     * @return \League\Fractal\Resource\Item|\League\Fractal\Resource\NullResource
     */
    public function includeArticle(Star $model)
    {
        $include = $model->article;
        return $include
            ? $this->item($include, new PublisherArticleTransformer())
            : $this->null();
    }
}