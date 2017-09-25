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
        if ($model->unlisted) {
            $this->response->errorForbidden('no_permission_to_show');
        }
        parent::beforeShow($request, $model);
    }
}