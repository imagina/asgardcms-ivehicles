<?php

namespace Modules\Ivehicles\Repositories\Cache;

use Modules\Ivehicles\Repositories\VehicleRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheVehicleDecorator extends BaseCacheDecorator implements VehicleRepository
{
    public function __construct(VehicleRepository $vehicle)
    {
        parent::__construct();
        $this->entityName = 'ivehicles.vehicles';
        $this->repository = $vehicle;
    }

    public function whereBrand($id)
    {
        // TODO: Implement whereBrand() method.
    }

    public function getItemsBy($params = false)
    {
        // TODO: Implement getItemsBy() method.
    }

    public function getItem($criteria, $params = false)
    {
        // TODO: Implement getItem() method.
    }
}
