<?php

namespace App\Http\Controllers;


use Symfony\Component\Routing\Exception\ResourceNotFoundException;

class ArticleSlugController extends Sluggable
{
    public function fromModel($model)
    {
        if ($model->unlisted)
            throw new ResourceNotFoundException("No permission to view model.");
        return parent::fromModel($model);
    }

    protected function controller()
    {
        return new ArticleController();
    }
}