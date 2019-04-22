<?php

namespace Modules\Ivehicles\Repositories\Cache;

use Modules\Ivehicles\Repositories\FeatureRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheFeatureDecorator extends BaseCacheDecorator implements FeatureRepository
{
    public function __construct(FeatureRepository $feature)
    {
        parent::__construct();
        $this->entityName = 'ivehicles.features';
        $this->repository = $feature;
    }
}
