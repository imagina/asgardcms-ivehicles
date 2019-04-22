<?php

namespace Modules\Ivehicles\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Ivehicles\Entities\Brand;
use Modules\Ivehicles\Entities\Status;
use Modules\Ivehicles\Http\Requests\CreateBrandRequest;
use Modules\Ivehicles\Http\Requests\UpdateBrandRequest;
use Modules\Ivehicles\Repositories\BrandRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;

class BrandController extends AdminBaseController
{
    /**
     * @var BrandRepository
     */
    private $brand;
    private $status;

    public function __construct(BrandRepository $brand, Status $status)
    {
        parent::__construct();

        $this->brand = $brand;
        $this->status=$status;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $brands = $this->brand->all();

        return view('ivehicles::admin.brands.index', compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $status=$this->status->lists();
        return view('ivehicles::admin.brands.create',compact('status'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateBrandRequest $request
     * @return Response
     */
    public function store(CreateBrandRequest $request)
    {
        $this->brand->create($request->all());

        return redirect()->route('admin.ivehicles.brand.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('ivehicles::brands.title.brands')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Brand $brand
     * @return Response
     */
    public function edit(Brand $brand)
    {
        return view('ivehicles::admin.brands.edit', compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Brand $brand
     * @param  UpdateBrandRequest $request
     * @return Response
     */
    public function update(Brand $brand, UpdateBrandRequest $request)
    {
        $this->brand->update($brand, $request->all());

        return redirect()->route('admin.ivehicles.brand.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('ivehicles::brands.title.brands')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Brand $brand
     * @return Response
     */
    public function destroy(Brand $brand)
    {
        $this->brand->destroy($brand);

        return redirect()->route('admin.ivehicles.brand.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('ivehicles::brands.title.brands')]));
    }
}
