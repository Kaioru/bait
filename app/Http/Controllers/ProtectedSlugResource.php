<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

abstract class ProtectedSlugResource extends ProtectedResource
{
    protected $controller;

    public function __construct()
    {
        $this->controller = $this->controller();
        parent::__construct();
    }

    abstract protected function controller();

    /**
     * Eloquent model.
     *
     * @return Model
     */
    protected function model(): Model
    {
        return $this->controller->model;
    }

    public function show(Request $request, $slug)
    {
        return parent::show($request, $this->fromSlug($slug));
    }

    public function fromSlug($slug)
    {
        return $this->model->where("slug", "=", $slug)->limit(1)->first()->id;
    }

    public function update(Request $request, $slug)
    {
        return parent::update($request, $this->fromSlug($slug));
    }

    public function destroy(Request $request, $slug)
    {
        return parent::destroy($request, $this->fromSlug($slug));
    }
}