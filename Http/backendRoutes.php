<?php

use Illuminate\Routing\Router;
/** @var Router $router */

$router->group(['prefix' =>'/ivehicles'], function (Router $router) {
    $router->bind('vehicle', function ($id) {
        return app('Modules\Ivehicles\Repositories\VehicleRepository')->find($id);
    });
    $router->get('vehicles', [
        'as' => 'admin.ivehicles.vehicle.index',
        'uses' => 'VehicleController@index',
        'middleware' => 'can:ivehicles.vehicles.index'
    ]);
    $router->get('vehicles/create', [
        'as' => 'admin.ivehicles.vehicle.create',
        'uses' => 'VehicleController@create',
        'middleware' => 'can:ivehicles.vehicles.create'
    ]);
    $router->post('vehicles', [
        'as' => 'admin.ivehicles.vehicle.store',
        'uses' => 'VehicleController@store',
        'middleware' => 'can:ivehicles.vehicles.create'
    ]);
    $router->get('vehicles/{vehicle}/edit', [
        'as' => 'admin.ivehicles.vehicle.edit',
        'uses' => 'VehicleController@edit',
        'middleware' => 'can:ivehicles.vehicles.edit'
    ]);
    $router->put('vehicles/{vehicle}', [
        'as' => 'admin.ivehicles.vehicle.update',
        'uses' => 'VehicleController@update',
        'middleware' => 'can:ivehicles.vehicles.edit'
    ]);
    $router->delete('vehicles/{vehicle}', [
        'as' => 'admin.ivehicles.vehicle.destroy',
        'uses' => 'VehicleController@destroy',
        'middleware' => 'can:ivehicles.vehicles.destroy'
    ]);
    $router->post('vehicles/gallery', [
        'as' => 'ivehicles.vehicles.gallery.store',
        'uses' => 'VehicleController@galleryStore',
        //'middleware' => ['api.token','token-can:ivehicles.vehicles.create']
    ]);
    $router->post('vehicles/gallery/delete', [
        'as' => 'ivehicles.vehicles.gallery.delete',
        'uses' => 'VehicleController@galleryDelete',
        // 'middleware' => ['api.token','token-can:ivehicles.vehicles.create']
    ]);
    
    $router->bind('brand', function ($id) {
        return app('Modules\Ivehicles\Repositories\BrandRepository')->find($id);
    });
    $router->get('brands', [
        'as' => 'admin.ivehicles.brand.index',
        'uses' => 'BrandController@index',
        'middleware' => 'can:ivehicles.brands.index'
    ]);
    $router->get('brands/create', [
        'as' => 'admin.ivehicles.brand.create',
        'uses' => 'BrandController@create',
        'middleware' => 'can:ivehicles.brands.create'
    ]);
    $router->post('brands', [
        'as' => 'admin.ivehicles.brand.store',
        'uses' => 'BrandController@store',
        'middleware' => 'can:ivehicles.brands.create'
    ]);
    $router->get('brands/{brand}/edit', [
        'as' => 'admin.ivehicles.brand.edit',
        'uses' => 'BrandController@edit',
        'middleware' => 'can:ivehicles.brands.edit'
    ]);
    $router->put('brands/{brand}', [
        'as' => 'admin.ivehicles.brand.update',
        'uses' => 'BrandController@update',
        'middleware' => 'can:ivehicles.brands.edit'
    ]);
    $router->delete('brands/{brand}', [
        'as' => 'admin.ivehicles.brand.destroy',
        'uses' => 'BrandController@destroy',
        'middleware' => 'can:ivehicles.brands.destroy'
    ]);
    $router->bind('feature', function ($id) {
        return app('Modules\Ivehicles\Repositories\FeatureRepository')->find($id);
    });
    $router->get('features', [
        'as' => 'admin.ivehicles.feature.index',
        'uses' => 'FeatureController@index',
        'middleware' => 'can:ivehicles.features.index'
    ]);
    $router->get('features/create', [
        'as' => 'admin.ivehicles.feature.create',
        'uses' => 'FeatureController@create',
        'middleware' => 'can:ivehicles.features.create'
    ]);
    $router->post('features', [
        'as' => 'admin.ivehicles.feature.store',
        'uses' => 'FeatureController@store',
        'middleware' => 'can:ivehicles.features.create'
    ]);
    $router->get('features/{feature}/edit', [
        'as' => 'admin.ivehicles.feature.edit',
        'uses' => 'FeatureController@edit',
        'middleware' => 'can:ivehicles.features.edit'
    ]);
    $router->put('features/{feature}', [
        'as' => 'admin.ivehicles.feature.update',
        'uses' => 'FeatureController@update',
        'middleware' => 'can:ivehicles.features.edit'
    ]);
    $router->delete('features/{feature}', [
        'as' => 'admin.ivehicles.feature.destroy',
        'uses' => 'FeatureController@destroy',
        'middleware' => 'can:ivehicles.features.destroy'
    ]);
    $router->bind('model', function ($id) {
        return app('Modules\Ivehicles\Repositories\ModelRepository')->find($id);
    });
    $router->get('models', [
        'as' => 'admin.ivehicles.model.index',
        'uses' => 'ModelController@index',
        'middleware' => 'can:ivehicles.models.index'
    ]);
    $router->get('models/create', [
        'as' => 'admin.ivehicles.model.create',
        'uses' => 'ModelController@create',
        'middleware' => 'can:ivehicles.models.create'
    ]);
    $router->post('models', [
        'as' => 'admin.ivehicles.model.store',
        'uses' => 'ModelController@store',
        'middleware' => 'can:ivehicles.models.create'
    ]);
    $router->get('models/{model}/edit', [
        'as' => 'admin.ivehicles.model.edit',
        'uses' => 'ModelController@edit',
        'middleware' => 'can:ivehicles.models.edit'
    ]);
    $router->put('models/{model}', [
        'as' => 'admin.ivehicles.model.update',
        'uses' => 'ModelController@update',
        'middleware' => 'can:ivehicles.models.edit'
    ]);
    $router->delete('models/{model}', [
        'as' => 'admin.ivehicles.model.destroy',
        'uses' => 'ModelController@destroy',
        'middleware' => 'can:ivehicles.models.destroy'
    ]);
// append




});
