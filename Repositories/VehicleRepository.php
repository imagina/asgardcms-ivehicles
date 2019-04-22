<?php

namespace Modules\Ivehicles\Repositories;

use Modules\Core\Repositories\BaseRepository;

interface VehicleRepository extends BaseRepository
{
    public function whereBrand($id);

    public function getItemsBy($params = false);

    public function getItem($criteria, $params = false);

    public function getAll();


}
