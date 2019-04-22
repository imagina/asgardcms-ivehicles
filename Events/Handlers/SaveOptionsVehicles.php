<?php

namespace Modules\Ivehicles\Events\Handlers;

use Modules\Ivehicles\Events\VehicleWasCreated;
use Modules\Ivehicles\Repositories\VehicleRepository;

/**
 * Class SaveOptionsVehicles
 * Save option main image and gallery
 * @package Modules\Ivehicles\Events\Handlers
 */
class SaveOptionsVehicles
{
    /**
     * @var VehicleRepository
     */
    private $vehicle;

    /**
     * SaveOptionsVehicles constructor.
     * @param VehicleRepository $vehicle
     */
    public function __construct(VehicleRepository $vehicle)
    {
        $this->vehicle = $vehicle;
    }

    /**
     * @param VehicleWasCreated $event
     * @return \Exception
     */
    public function handle(VehicleWasCreated $event)
    {
        $entity = $event->entity;
        $data = $event->data;
        \DB::beginTransaction();
        try
        {
            isset($data['options'])?$options = (array)$data['options']:$options = array();
            $disk='publicmedia';

            if (!empty($data['mainimage']))
            {

                $mainimage = saveImage($data['mainimage'], "assets/ivehicles/vehicle/" . $entity->id . ".jpg");
                $options["mainimage"] = $mainimage;
                $data['options'] = $options;
            } else {
                $data['options'] = $data['options'];
            }
            if (!empty($data['gallery']) && !empty($entity->id))
            {
                if (count(\Storage::disk($disk)->files('assets/ivehicles/vehicle/gallery/' . $data['gallery'])))
                {
                    \File::makeDirectory('assets/ivehicles/vehicle/gallery/' . $entity->id);
                    $success = rename('assets/ivehicles/vehicle/gallery/' . $data['gallery'], 'assets/ivehicles/vechilce/gallery/' . $entity->id);
                }
            }
            $model = $this->vehicle->update($entity, $data);

            return $model;
            \DB::commit(); //Commit to Data Base
        } catch (\Exception $e)
        {
            \DB::rollback();
            \Log::error($e);
            return $e;
        }

    }

}