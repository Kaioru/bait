<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

abstract class Sluggable extends Resource
{
    protected $controller;

    public function __construct()
    {
        $this->controller = $this->controller();
        parent::__construct();
    }

    abstract protected function controller();

    public function show($slug)
    {
        return parent::show($this->fromSlug($slug));
    }

    public function fromSlug($slug)
    {
        $model = $this->model->where("slug", "=", $slug)->limit(1)->first();
        return $this->fromModel($model);
    }

    public function fromModel($model)
    {
        return $model->id;
    }

    public function update(Request $request, $slug)
    {
        return parent::update($request, $this->fromSlug($slug));
    }

    public function destroy(Request $request, $slug)
    {
        return parent::destroy($request, $this->fromSlug($slug));
    }

    /**
     * Eloquent model.
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    protected function model()
    {
        return $this->controller->model;
    }

    /**
     * Transformer for the current model.
     *
     * @return \League\Fractal\TransformerAbstract
     */
    protected function transformer()
    {
        return $this->controller->transformer;
    }
}