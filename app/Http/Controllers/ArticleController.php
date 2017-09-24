<?php

namespace App\Http\Controllers;


use App\Article;
use App\Transformers\ArticleTransformer;

class ArticleController extends ProtectedResource
{

    /**
     * Eloquent model.
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    protected function model()
    {
        return new Article();
    }

    /**
     * Transformer for the current model.
     *
     * @return \League\Fractal\TransformerAbstract
     */
    protected function transformer()
    {
        return new ArticleTransformer();
    }
}