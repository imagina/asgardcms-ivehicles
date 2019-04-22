<?php

namespace Modules\Ivehicles\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;
use Modules\Ivehicles\Entities\Fuel;
use Modules\Ivehicles\Entities\Status;
use Modules\Ivehicles\Entities\Transmission;
use Modules\Ivehicles\Entities\TypeFeature;
use Modules\Ivehicles\Entities\Vehicle;
use Modules\Ivehicles\Http\Requests\CreateVehicleRequest;
use Modules\Ivehicles\Http\Requests\UpdateVehicleRequest;
use Modules\Ivehicles\Repositories\BrandRepository;
use Modules\Ivehicles\Repositories\FeatureRepository;
use Modules\Ivehicles\Repositories\ModelRepository;
use Modules\Ivehicles\Repositories\VehicleRepository;
use Modules\User\Repositories\RoleRepository;
use Modules\User\Repositories\UserRepository;

class VehicleController extends AdminBaseController
{
    /**
     * @var VehicleRepository
     */
    private $vehicle;
    private $user;
    private $role;
    private $brand;
    private $modelVehicle;
    private $features;
    private $typeFeature;
    private $fuel;
    private $transmission;
    private $status;

    public function __construct(VehicleRepository $vehicle, BrandRepository $brand, ModelRepository $modelVehicle, UserRepository $user, RoleRepository $role, FeatureRepository $feature, TypeFeature $typeFeature, Fuel $fuel, Transmission $transmission, Status $status)
    {
        parent::__construct();

        $this->vehicle = $vehicle;
        $this->user = $user;
        $this->role = $role;
        $this->brand = $brand;
        $this->modelVehicle = $modelVehicle;
        $this->features = $feature;
        $this->typeFeature = $typeFeature;
        $this->fuel = $fuel;
        $this->transmission = $transmission;
        $this->status = $status;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $vehicles = $this->vehicle->all();

        return view('ivehicles::admin.vehicles.index', compact('vehicles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {

        $owners = $this->role->findByName(config('asgard.ivehicles.config.roles.owner', 'superadmin'))->users;
        $brands = $this->brand->all();
        $features = $this->features->all();
        $typeFeature = $this->typeFeature;
        $fuel = $this->fuel->lists();
        $transmission = $this->transmission->lists();
        $status = $this->status->lists();
        return view('ivehicles::admin.vehicles.create', compact('owners', 'brands', 'features', 'typeFeature', 'fuel', 'transmission', 'status'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateVehicleRequest $request
     * @return Response
     */
    public function store(CreateVehicleRequest $request)
    {
        try {
            $this->vehicle->create($request->all());

            return redirect()->route('admin.ivehicles.vehicle.index')
                ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('ivehicles::vehicles.title.vehicles')]));
        } catch (Exception $e) {
            \Log::error($e);
            return redirect()->back()
                ->withError(trans('core::core.messages.resource error', ['name' => trans('ivehicles::vehicles.title.vehicles')]))->withInput($request->all());
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Vehicle $vehicle
     * @return Response
     */
    public function edit(Vehicle $vehicle)
    {
        $owners = $this->role->findByName(config('asgard.ivehicles.config.roles.owner', 'superadmin'))->users;
        $brands = $this->brand->all();
        $features = $this->features->all();
        $typeFeature = $this->typeFeature;
        $fuel = $this->fuel->lists();
        $transmission = $this->transmission->lists();
        $status = $this->status->lists();
        $models = $this->modelVehicle->getItemsBy(json_decode(json_encode(['filter' => ['brand' => $vehicle->brand_id], 'take' => null, 'include' => array()])));

        return view('ivehicles::admin.vehicles.edit', compact('vehicle', 'owners', 'brands', 'models', 'features', 'typeFeature', 'fuel', 'transmission', 'status'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Vehicle $vehicle
     * @param  UpdateVehicleRequest $request
     * @return Response
     */
    public function update(Vehicle $vehicle, UpdateVehicleRequest $request)
    {
        try {

            if (isset($request['options'])) {
                $options = (array)$request['options'];
            } else {
                $options = array();
            }


            isset($request->mainimage) ? $options["mainimage"] = saveImage($request['mainimage'], "assets/ivehicles/vehicle/" . $vehicle->id . ".jpg") : false;

            $request['options'] = $options;
            $this->vehicle->update($vehicle, $request->all());

            return redirect()->route('admin.ivehicles.vehicle.index')
                ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('ivehicles::vehicles.title.vehicles')]));
        } catch (Exception $e) {
            \Log::error($e);
            return redirect()->back()
                ->withError(trans('core::core.messages.resource error', ['name' => trans('ivehicles::vehicles.title.vehicles')]))->withInput($request->all());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Vehicle $vehicle
     * @return Response
     */
    public function destroy(Vehicle $vehicle)
    {
        $this->vehicle->destroy($vehicle);

        return redirect()->route('admin.ivehicles.vehicle.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('ivehicles::vehicles.title.vehicles')]));
    }

    public function galleryStore(Request $request)
    {
        try {

            $original_filename = $request->file('file')->getClientOriginalName();

            $idplace = $request->input('idedit');
            $extension = $request->file('file')->getClientOriginalExtension();
            $allowedextensions = array('JPG', 'JPEG', 'PNG', 'GIF');

            if (!in_array(strtoupper($extension), $allowedextensions)) {
                return 0;
            }
            $disk = 'publicmedia';
            $image = \Image::make($request->file('file'));
            $name = str_slug(str_replace('.' . $extension, '', $original_filename), '-');

            $image->resize(config('asgard.ivehicles.config.imagesize.width'), config('asgard.ivehicles.config.imagesize.height'), function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });

            if (config('asgard.ivehicles.config.watermark.activated')) {
                $image->insert(config('asgard.ivehicles.config.watermark.url'), config('asgard.ivehicles.config.watermark.position'), config('asgard.ivehicles.config.watermark.x'), config('asgard.ivehicles.config.watermark.y'));
            }
            $nameimag = $name . '.' . $extension;
            $destination_path = 'assets/ivehicles/vehicles/gallery/' . $idplace . '/' . $nameimag;

            \Storage::disk($disk)->put($destination_path, $image->stream($extension, '100'));

            return array('direccion' => $destination_path);
        } catch (\Exception $e) {
            return $e->getMessage();
        }

    }

    public function galleryDelete(Request $request)
    {
        $disk = "publicmedia";
        $dirdata = $request->input('dirdata');
        \Storage::disk($disk)->delete($dirdata);
        return array('success' => true);
    }
}
