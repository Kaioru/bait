<?php

namespace App;


use League\Fractal\TransformerAbstract;

abstract class Publisher extends Model
{
    /**
     * Get the transformer for the model.
     *
     * @return TransformerAbstract
     */
    abstract function parentTransformer(): TransformerAbstract;
}