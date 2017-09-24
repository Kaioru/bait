<?php

namespace App;


use Illuminate\Database\Eloquent\Model as BaseModel;
use League\Fractal\TransformerAbstract;

abstract class Model extends BaseModel
{
    /**
     * Get the transformer for the model.
     *
     * @return TransformerAbstract
     */
    abstract function transformer(): TransformerAbstract;
}