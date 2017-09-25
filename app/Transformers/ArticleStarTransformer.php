<?php

namespace App\Transformers;


use App\Transformers\Traits\ArticleStarTrait;
use App\Transformers\Traits\StarTrait;
use League\Fractal\TransformerAbstract;

class ArticleStarTransformer extends TransformerAbstract
{
    use StarTrait, ArticleStarTrait;

    /**
     * List of resources to automatically include
     *
     * @var array
     */
    protected $defaultIncludes = [
        'user',
    ];
}