<?php

namespace Modules\Ivehicles\Repositories\Cache;

use Modules\Ivehicles\Repositories\BrandRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheBrandDecorator extends BaseCacheDecorator implements BrandRepository
{
    public function __construct(BrandRepository $brand)
    {
        parent::__construct();
        $this->entityName = 'ivehicles.brands';
        $this->repository = $brand;
    }
}
