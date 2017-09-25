<?php

namespace App\Transformers;

use App\Transformers\Traits\ArticleStarTrait;
use App\Transformers\Traits\StarTrait;
use App\Transformers\Traits\UserStarTrait;
use League\Fractal\TransformerAbstract;

class StarTransformer extends TransformerAbstract
{
    use StarTrait, UserStarTrait, ArticleStarTrait;

    /**
     * List of resources to automatically include
     *
     * @var array
     */
    protected $defaultIncludes = [
        'user',
        'article',
    ];
}