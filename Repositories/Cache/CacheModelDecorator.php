<?php

namespace Modules\Ivehicles\Repositories\Cache;

use Modules\Ivehicles\Repositories\ModelRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheModelDecorator extends BaseCacheDecorator implements ModelRepository
{
    public function __construct(ModelRepository $model)
    {
        parent::__construct();
        $this->entityName = 'ivehicles.models';
        $this->repository = $model;
    }
}
