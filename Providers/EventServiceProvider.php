<?php

namespace Modules\Ivehicles\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Modules\Ivehicles\Events\Handlers\SaveOptionsVehicles;
use Modules\Ivehicles\Events\VehicleWasCreated;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        VehicleWasCreated::class => [
            SaveOptionsVehicles::class,
        ]
    ];
}
