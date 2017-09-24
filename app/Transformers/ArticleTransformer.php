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
        'owner',
        'pages',
    ];

    /**
     * List of resources available for include
     *
     * @var array
     */
    protected $availableIncludes = [

    ];

    public function transform(Article $model)
    {
        return [
            'id' => (int)$model->id,
            'title' => (string)$model->title,
            'content' => (string)$model->content,
            'unlisted' => (boolean)$model->unlisted,
        ];
    }

    /**
     * Include Owner
     *
     * @param Article $model
     * @return \League\Fractal\Resource\Item
     */
    public function includeOwner(Article $model)
    {
        $include = $model->owner;
        return $include
            ? $this->item($include, new UserTransformer())
            : $this->null();
    }

    /**
     * Include Page
     *
     * @param Article $model
     * @return \League\Fractal\Resource\Item
     */
    public function includePages(Article $model)
    {
        $include = $model->pages;
        return $include
            ? $this->collection($include, new PageTransformer())
            : $this->null();
    }
}