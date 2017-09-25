<?php

namespace App\Transformers;


use App\User;
use League\Fractal\TransformerAbstract;

class UserTransformer extends TransformerAbstract
{
    /**
     * List of resources to automatically include
     *
     * @var array
     */
    protected $defaultIncludes = [
        'stars',
    ];

    public function transform(User $model)
    {
        return [
            'id' => (int)$model->id,
            'username' => (string)$model->username,
        ];
    }

    /**
     * Include stars
     *
     * @param User $model
     * @return \League\Fractal\Resource\Collection|\League\Fractal\Resource\NullResource
     */
    public function includeStars(User $model)
    {
        $include = $model->stars;
        return $include
            ? $this->collection($include, new UserStarTransformer())
            : $this->null();
    }
}