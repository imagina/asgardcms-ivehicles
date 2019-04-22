<?php

namespace Modules\Ivehicles\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Ivehicles\Entities\Feature;
use Modules\Ivehicles\Http\Requests\CreateFeatureRequest;
use Modules\Ivehicles\Http\Requests\UpdateFeatureRequest;
use Modules\Ivehicles\Repositories\FeatureRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;

class FeatureController extends AdminBaseController
{
    /**
     * @var FeatureRepository
     */
    private $feature;

    public function __construct(FeatureRepository $feature)
    {
        parent::__construct();

        $this->feature = $feature;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $features = $this->feature->all();

        return view('ivehicles::admin.features.index', compact(''));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('ivehicles::admin.features.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateFeatureRequest $request
     * @return Response
     */
    public function store(CreateFeatureRequest $request)
    {
        $this->feature->create($request->all());

        return redirect()->route('admin.ivehicles.feature.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('ivehicles::features.title.features')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Feature $feature
     * @return Response
     */
    public function edit(Feature $feature)
    {
        return view('ivehicles::admin.features.edit', compact('feature'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Feature $feature
     * @param  UpdateFeatureRequest $request
     * @return Response
     */
    public function update(Feature $feature, UpdateFeatureRequest $request)
    {
        $this->feature->update($feature, $request->all());

        return redirect()->route('admin.ivehicles.feature.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('ivehicles::features.title.features')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Feature $feature
     * @return Response
     */
    public function destroy(Feature $feature)
    {
        $this->feature->destroy($feature);

        return redirect()->route('admin.ivehicles.feature.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('ivehicles::features.title.features')]));
    }
}
