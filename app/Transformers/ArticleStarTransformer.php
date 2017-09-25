<?php

namespace App\Transformers;


use App\Star;
use App\User;
use League\Fractal\TransformerAbstract;

class ArticleStarTransformer extends TransformerAbstract
{
    /**
     * List of resources to automatically include
     *
     * @var array
     */
    protected $defaultIncludes = [
        'user',
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
    public function includeUser(Star $model)
    {
        $include = $model->user;
        return $include
            ? $this->item($include, new ArticleUserTransformer())
            : $this->null();
    }
}