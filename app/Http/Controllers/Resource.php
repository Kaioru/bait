<?php

namespace App\Http\Controllers;

use Dingo\Api\Exception\StoreResourceFailedException;
use Dingo\Api\Exception\UpdateResourceFailedException;
use Dingo\Api\Routing\Helpers;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller;
use League\Fractal\TransformerAbstract;

abstract class Resource extends Controller
{
    use Helpers;

    /**
     * Eloquent model instance.
     *
     * @var Model;
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
     */
    public function __construct()
    {
        $this->model = $this->model();
        $this->transformer = $this->transformer();
    }

    /**
     * Eloquent model.
     *
     * @return Model
     */
    abstract protected function model(): Model;

    /**
     * Transformer for the current model.
     *
     * @return \League\Fractal\TransformerAbstract
     */
    protected function transformer(): TransformerAbstract
    {
        return $this->model()->transformer();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $models = $this->model->paginate(15);
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
        return $model->validation;
        $validator = $this->getValidationFactory()->make($request->all(), $model->validation);

        $this->beforeStore($request, $model);

        if ($validator->fails()) {
            throw new StoreResourceFailedException('Could not store new model.', $validator->errors());
        }
        $model->save();
        return $this->response->item($model, $transformer);
    }

    protected function beforeStore(Request $request, Model $model)
    {
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
    protected function find($id)
    {
        return $this->model->findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $model = $this->find($id);
        $transformer = $this->transformer;
        $validator = $this->getValidationFactory()->make($request->all(), $model->validation);

        $this->beforeUpdate($request, $model);

        if ($validator->fails()) {
            throw new UpdateResourceFailedException('Could not update model.', $validator->errors());
        }

        $model->update($request->all());
        return $this->response->item($model, $transformer);
    }

    protected function beforeUpdate(Request $request, Model $model)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $model = $this->find($id);
        $this->beforeDestroy($request, $model);
        $model->delete();
        return $this->response->noContent();
    }

    protected function beforeDestroy(Request $request, Model $model)
    {
    }
}