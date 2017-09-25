<?php

namespace App;


use League\Fractal\TransformerAbstract;

class Star extends Model
{
    /**
     * Get the transformer for the model.
     *
     * @return TransformerAbstract
     */
    function transformer(): TransformerAbstract
    {
        // TODO: Implement transformer() method.
    }

    /**
     * Get the star's article.
     */
    public function article()
    {
        return $this->belongsTo(Article::class);
    }

    /**
     * Get the star's user.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}