<?php

namespace App;


use App\Transformers\PageTransformer;
use League\Fractal\TransformerAbstract;

class Page extends Model
{
    /**
     * Get the page's article.
     */
    public function article()
    {
        return $this->belongsTo(Article::class);
    }

    /**
     * Get the transformer for the model.
     *
     * @return TransformerAbstract
     */
    function transformer(): TransformerAbstract
    {
        return new PageTransformer();
    }
}