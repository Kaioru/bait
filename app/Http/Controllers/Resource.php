<?php

namespace App\Http\Controllers;

use Dingo\Api\Exception\StoreResourceFailedException;
use Dingo\Api\Exception\UpdateResourceFailedException;
use Dingo\Api\Routing\Helpers;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller as BaseController;

abstract class Resource extends BaseController
{
    use Helpers;

    /**
     * Eloquent model instance.
     *
     * @var \Illuminate\Database\Eloquent\Model;
     */
    protected $model;

    /**
     * Fractal Transformer instance.
     *
     * @var \League\Fractal\TransformerAbstract
     */
    protected $transformer;

    /**
     * Constructor.
     *
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->model = $this->model();
        $this->transformer = $this->transformer();
    }

    /**
     * Eloquent model.
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    abstract protected function model();

    /**
     * Transformer for the current model.
     *
     * @return \League\Fractal\TransformerAbstract
     */
    abstract protected function transformer();

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $models = $this->model->paginate(25);
        $transformer = $this->transformer;
        return $this->response->paginator($models, $transformer);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $model = new $this->model($request->all());
        $transformer = $this->transformer;
        $validator = $this->getValidationFactory()->make($request->all(), $model->validation);
        if ($validator->fails()) {
            throw new StoreResourceFailedException('Could not store new model.', $validator->errors());
        }
        $model->save();
        return $this->response->item($model, $transformer);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $model = $this->find($id);
        $transformer = $this->transformer;
        return $this->response->item($model, $transformer);
    }

    /**
     * Finds the specified resource.
     * @param int $id
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function find($id)
    {
        return $this->model->findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $model = $this->find($id);
        $transformer = $this->transformer;
        $validator = $this->getValidationFactory()->make($request->all(), $model->validation);
        if ($validator->fails()) {
            throw new UpdateResourceFailedException('Could not update model.', $validator->errors());
        }
        $model->update($request->all());
        return $this->response->item($model, $transformer);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->model->destroy($id);
        return $this->response->noContent();
    }
}
