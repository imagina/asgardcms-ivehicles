<?php

namespace Modules\Ivehicles\Repositories\Eloquent;

use Modules\Core\Repositories\Eloquent\EloquentBaseRepository;
use Modules\Ivehicles\Events\VehicleWasCreated;
use Modules\Ivehicles\Repositories\VehicleRepository;
use Illuminate\Database\Eloquent\Builder;


class EloquentVehicleRepository extends EloquentBaseRepository implements VehicleRepository
{
    /**
     * @param bool $params
     * @return mixed
     */
    public function getItemsBy($params = false)
    {

        $query = $this->model->query();

        if (in_array('*', $params->include)) {
            $query->with([]);
        } else {
            $includeDefault = ['translations'];
            if (isset($params->include))
                $includeDefault = array_merge($includeDefault, $params->include);
            $query->with($includeDefault);
        }


        if (isset($params->filter)) {
            $filter = $params->filter;
            if (isset($filter->brands)){
                $brands= is_array($filter->brands)?$filter->brands:[$filter->brands];
                $query->whereIn('brand_id',$brands);
            }
            if (isset($filter->models)){
                $models= is_array($filter->models)?$filter->models:[$filter->models];
                $query->whereIn('model_id',$models);
            }
            if (isset($filter->featured) && $filter->featured??false){
                $query->where('featured',1);
            }
            if (isset($filter->price)) { //si hay que filtrar por rango de precio
                $price = $filter->price;
                $query->whereBetween('price', [$price->min ?? 0, $price->max ?? 9999999999999999]);
            }
            if (isset($filter->year)) { //si hay que filtrar por rango de precio
                $year = $filter->year;
                $query->whereBetween('year', [$year->min ?? 0, $year->max ?? 9999999999999999]);
            }
            if (isset($filter->mileage)) { //si hay que filtrar por rango de precio
                $mileage = $filter->mileage;
                $query->whereBetween('mileage', [$mileage->min ?? 0, $year->mileage ?? 9999999999999999]);
            }
            if (isset($filter->fuel)){
                $fuel= is_array($filter->fuel)?$filter->fuel:[$filter->fuel];
                $query->whereIn('fuel',$fuel);

            }
            if (isset($filter->search)) { //si hay que filtrar por rango de precio
                $criterion = $filter->search;
                $param = explode(' ', $criterion);
                $query->where(function ($query) use ($param) {
                    foreach ($param as $index => $word) {
                        if ($index == 0) {
                            $query->where('title', 'like', "%" . $word . "%");
                            $query->orWhere('sku', 'like', "%" . $word . "%");
                        } else {
                            $query->orWhere('title', 'like', "%" . $word . "%");
                            $query->orWhere('sku', 'like', "%" . $word . "%");
                        }
                    }

                });
            }
            if (isset($filter->date)) {
                $date = $filter->date;
                $date->field = $date->field ?? 'created_at';
                if (isset($date->from))
                    $query->whereDate($date->field, '>=', $date->from);
                if (isset($date->to))
                    $query->whereDate($date->field, '<=', $date->to);
            }


            if (isset($filter->order)) {

                $orderByField = $filter->order->field ?? 'created_at';
                $orderWay = $filter->order->way ?? 'desc';
                $query->orderBy($orderByField, $orderWay);
            }
            if (isset($filter->status)) {
                $query->whereStatus($filter->status);
            }
        }


        if (isset($params->fields) && count($params->fields))
            $query->select($params->fields);

        if (isset($params->page) && $params->page) {
            return $query->paginate($params->take);
        } else {
            $params->take ? $query->take($params->take) : false;
            return $query->get();
        }
    }

    /**
     * @param $criteria
     * @param bool $params
     * @return mixed
     */
    public function getItem($criteria, $params = false)
    {

        $query = $this->model->query();


        if (in_array('*', $params->include)) {
            $query->with([]);
        } else {
            $includeDefault = ['translations'];
            if (isset($params->include))
                $includeDefault = array_merge($includeDefault, $params->include);
            $query->with($includeDefault);
        }

        if (isset($params->filter)) {
            $filter = $params->filter;

            if (isset($filter->field))
                $field = $filter->field;
        }


        if (isset($params->fields) && count($params->fields))
            $query->select($params->fields);


        return $query->where($field ?? 'id', $criteria)->first();
    }

    /**
     * @inheritdoc
     */
    public function create($data)
    {
        $model = $this->model->create($data);
        event(new VehicleWasCreated($model, $data));

        $model->features()->sync(array_get($data, 'features', []));

        return $model;

    }

    /**
     * @inheritdoc
     */
    public function update($model, $data)
    {
        $model->update($data);

        $model->features()->sync(array_get($data, 'features', []));

        return $model;
    }


    public function whereBrand($id)
    {
        $query = $this->model->with('translations', 'modelVehicle', 'brand', 'owner')->where('brand_id', $id)->active()->paginate(12);

        return $query;
    }

    public function findBySlug($slug)
    {

        return $this->model->whereHas('translations', function (Builder $q) use ($slug) {
            $q->where('slug', $slug);
        })->with('translations', 'modelVehicle', 'brand', 'owner', 'features')->active()->orderBy('created_at', 'desc')->firstOrFail();

    }

    public function getAll()
    {
        return $this->model->query()->with('translations', 'modelVehicle', 'brand', 'owner')->active()->orderBy('created_at', 'desc')->paginate(12);
    }
}
