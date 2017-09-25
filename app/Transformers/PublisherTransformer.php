<?php

namespace App\Transformers;


use App\Publisher;
use League\Fractal\TransformerAbstract;

class PublisherTransformer extends TransformerAbstract
{
    /**
     * Include articles
     *
     * @param Publisher $model
     * @return \League\Fractal\Resource\Collection|\League\Fractal\Resource\NullResource
     */
    public function includeArticles(Publisher $model)
    {
        $include = $model->articles;
        return $include
            ? $this->collection($include, new PublisherArticleTransformer())
            : $this->null();
    }
}