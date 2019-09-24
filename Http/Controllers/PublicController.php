<?php

namespace Modules\Ivehicles\Http\Controllers;

use Illuminate\Http\Request;
use Log;
use Mockery\CountValidator\Exception;
use Modules\Core\Http\Controllers\BasePublicController;
use Modules\Ivehicles\Repositories\BrandRepository;
use Modules\Ivehicles\Repositories\VehicleRepository;
use Route;

class PublicController extends BasePublicController
{
    private $vehicles;
    private $brands;

    public function __construct(VehicleRepository $vehicle, BrandRepository $brand)
    {
        parent::__construct();
        $this->vehicles = $vehicle;
        $this->brands = $brand;
    }

    public function all()
    {

        //Default Template
        $tpl = 'ivehicles::frontend.index';
        $brand = (object)["title" => trans('ivehicles::common.title.all'), "description" => trans('ivehicles::common.title.description')];
        $vehicles = $this->vehicles->getAll();

        //Get Custom Template.

        return view($tpl, compact('brand', 'vehicles'));
    }

    public function search(Request $request)
    {
        $search = (object)$request->all();
        //Default Template
        $tpl = 'ivehicles::frontend.index';
        $brand = (object)["title" => trans('ivehicles::common.title.all'), "description" => trans('ivehicles::common.title.description')];
        try {
            if (isset($search) && !empty($search)) {
               // dd($search);
                $params = json_decode(json_encode(['filter' => ['price' => ['min' => $search->minprice, 'max' => $search->maxprice], 'year' => ['min' => $search->yearsince, 'max' => $search->yearto], 'brands' => $search->brand ?? null, 'models' => $search->model ?? null, 'search' => $search->search ?? null], 'include' => [], 'take' => 12, 'page' => $search->page ?? 1]));
                $vehicles = $this->vehicles->getItemsBy($params);

            } else {
                $vehicles = null;
            }

        } catch (\Exception $e) {
            \Log::error($e);
            $vehicles = null;
        }



        //Get Custom Template.

        return view($tpl, compact('brand', 'vehicles'));
    }

    public function index($slug)
    {

        //Default Template
        $tpl = 'ivehicles::frontend.index';

        $brand = $this->brands->findBySlug($slug);
        $vehicles = $this->vehicles->whereBrand($brand->id);
        //Get Custom Template.

        return view($tpl, compact('brand', 'vehicles'));

    }

    /**
     * @param $categorySlug
     * @param $vehicle
     * @return mixed
     */
    public function show($categorySlug, $vehicle)
    {
        $tpl = 'ivehicles::frontend.show';

        $brand = $this->brands->findBySlug($categorySlug);
        $vehicle = $this->vehicles->findBySlug($vehicle);
        if ($vehicle->brand->slug != $brand->slug) return abort(404);

        return view($tpl, compact('brand', 'vehicle'));
    }
}