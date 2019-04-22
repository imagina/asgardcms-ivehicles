<?php

namespace Modules\Ivehicles\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Core\Traits\CanPublishConfiguration;
use Modules\Core\Events\BuildingSidebar;
use Modules\Core\Events\LoadingBackendTranslations;
use Modules\Ivehicles\Events\Handlers\RegisterIvehiclesSidebar;

class IvehiclesServiceProvider extends ServiceProvider
{
    use CanPublishConfiguration;
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerBindings();
        $this->app['events']->listen(BuildingSidebar::class, RegisterIvehiclesSidebar::class);

        $this->app['events']->listen(LoadingBackendTranslations::class, function (LoadingBackendTranslations $event) {
            $event->load('vehicles', array_dot(trans('ivehicles::vehicles')));
            $event->load('brands', array_dot(trans('ivehicles::brands')));
            $event->load('features', array_dot(trans('ivehicles::features')));
            $event->load('models', array_dot(trans('ivehicles::models')));
            // append translations




        });
    }

    public function boot()
    {
        $this->publishConfig('ivehicles', 'permissions');
        $this->publishConfig('ivehicles', 'config');
        //$this->publishConfig('ivehicles', 'settings');
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array();
    }

    private function registerBindings()
    {
        $this->app->bind(
            'Modules\Ivehicles\Repositories\VehicleRepository',
            function () {
                $repository = new \Modules\Ivehicles\Repositories\Eloquent\EloquentVehicleRepository(new \Modules\Ivehicles\Entities\Vehicle());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Ivehicles\Repositories\Cache\CacheVehicleDecorator($repository);
            }
        );
        $this->app->bind(
            'Modules\Ivehicles\Repositories\BrandRepository',
            function () {
                $repository = new \Modules\Ivehicles\Repositories\Eloquent\EloquentBrandRepository(new \Modules\Ivehicles\Entities\Brand());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Ivehicles\Repositories\Cache\CacheBrandDecorator($repository);
            }
        );
        $this->app->bind(
            'Modules\Ivehicles\Repositories\FeatureRepository',
            function () {
                $repository = new \Modules\Ivehicles\Repositories\Eloquent\EloquentFeatureRepository(new \Modules\Ivehicles\Entities\Feature());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Ivehicles\Repositories\Cache\CacheFeatureDecorator($repository);
            }
        );
        $this->app->bind(
            'Modules\Ivehicles\Repositories\ModelRepository',
            function () {
                $repository = new \Modules\Ivehicles\Repositories\Eloquent\EloquentModelRepository(new \Modules\Ivehicles\Entities\ModelVehicle());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Ivehicles\Repositories\Cache\CacheModelDecorator($repository);
            }
        );
// add bindings




    }
}
