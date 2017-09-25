<?php

namespace App\Transformers\Traits;

use App\Star;
use App\Transformers\PublisherArticleTransformer;

trait UserStarTrait
{
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