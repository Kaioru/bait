<?php

namespace App\Transformers;


use App\Team;

class TeamTransformer extends PublisherTransformer
{
    /**
     * List of resources to automatically include
     *
     * @var array
     */
    protected $defaultIncludes = [
        'articles',
    ];

    public function transform(Team $model)
    {
        return [
            'id' => (int)$model->id,
            'name' => (string)$model->name,
        ];
    }
}