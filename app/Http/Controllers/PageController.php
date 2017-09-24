<?php

namespace App\Http\Controllers;


use App\Page;
use App\Transformers\PageTransformer;

class PageController extends ProtectedResource
{

    /**
     * Eloquent model.
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    protected function model()
    {
        return new Page();
    }

    /**
     * Transformer for the current model.
     *
     * @return \League\Fractal\TransformerAbstract
     */
    protected function transformer()
    {
        return new PageTransformer();
    }
}