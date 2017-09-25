<?php

namespace App\Transformers\Traits;


use App\Star;
use App\Transformers\ArticleUserTransformer;

trait ArticleStarTrait
{
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