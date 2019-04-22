<?php

namespace Modules\Ivehicles\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Ivehicles\Entities\ModelVehicle;
use Modules\Ivehicles\Http\Requests\CreateModelRequest;
use Modules\Ivehicles\Http\Requests\UpdateModelRequest;
use Modules\Ivehicles\Repositories\BrandRepository;
use Modules\Ivehicles\Repositories\ModelRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;

class ModelController extends AdminBaseController
{
    /**
     * @var ModelRepository
     */
    private $model;

    private $brand;

    public function __construct(ModelRepository $model, BrandRepository $brand)
    {
        parent::__construct();

        $this->model = $model;
        $this->brand=$brand;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $models = $this->model->all();

        return view('ivehicles::admin.models.index', compact('models'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $brands=$this->brand->all();

        return view('ivehicles::admin.models.create',compact('brands'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateModelRequest $request
     * @return Response
     */
    public function store(CreateModelRequest $request)
    {
        $this->model->create($request->all());

        return redirect()->route('admin.ivehicles.model.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('ivehicles::models.title.models')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  ModelVehicle $model
     * @return Response
     */
    public function edit(ModelVehicle $model)
    {
        $brands=$this->brand->all();
        return view('ivehicles::admin.models.edit', compact('model','brands'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  ModelVehicle $model
     * @param  UpdateModelRequest $request
     * @return Response
     */
    public function update(ModelVehicle $model, UpdateModelRequest $request)
    {
        $this->model->update($model, $request->all());

        return redirect()->route('admin.ivehicles.model.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('ivehicles::models.title.models')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  ModelVehicle $model
     * @return Response
     */
    public function destroy(ModelVehicle $model)
    {
        $this->model->destroy($model);

        return redirect()->route('admin.ivehicles.model.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('ivehicles::models.title.models')]));
    }
}
