<?php

namespace Modules\Ivehicles\Repositories;

use Modules\Core\Repositories\BaseRepository;

interface BrandRepository extends BaseRepository
{
    public function getItemsBy($params = false);

    public function getItem($criteria, $params = false);


}
