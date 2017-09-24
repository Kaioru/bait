<?php

namespace App;

use App\Transformers\ArticleTransformer;
use League\Fractal\TransformerAbstract;

class Article extends Model
{
    /**
     * Get the article's publisher.
     */
    public function publisher()
    {
        return $this->morphTo();
    }

    /**
     * Get the article's pages.
     */
    public function pages()
    {
        $this->hasMany(Page::class);
    }

    /**
     * Get the transformer for the model.
     *
     * @return TransformerAbstract
     */
    function transformer(): TransformerAbstract
    {
        return new ArticleTransformer();
    }
}