<?php

namespace App\Transformers;


use App\Transformers\Traits\StarTrait;
use App\Transformers\Traits\UserStarTrait;
use League\Fractal\TransformerAbstract;

class UserStarTransformer extends TransformerAbstract
{
    use StarTrait, UserStarTrait;

    /**
     * List of resources to automatically include
     *
     * @var array
     */
    protected $defaultIncludes = [
        'article',
    ];
}