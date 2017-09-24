<?php

namespace App\Http\Controllers;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;

class ArticleSlugController extends ProtectedSlugResource
{
    protected function controller()
    {
        return new ArticleController();
    }

    public function beforeShow(Request $request, Model $model)
    {
        if ($model->unlisted)
            throw new ResourceNotFoundException("No permission to view model.");
        parent::beforeShow($request, $model);
    }
}