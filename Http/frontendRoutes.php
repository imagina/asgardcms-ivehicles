<?php

use Illuminate\Routing\Router;

/** @var Router $router */


$router->group(['prefix' => 'vehiculos'], function (Router $router) {

    $router->get('/', [
        'as' => 'ivehicles.vehicle.all',
        'uses' => 'PublicController@all',
        //'middleware' => 'can:ivehicles.vehicles.index'
    ]);
    $router->get('/q', [
        'as' => 'ivehicles.vehicle.search',
        'uses' => 'PublicController@search',
        //'middleware' => 'can:ivehicles.vehicles.index'
    ]);
    $router->get('{slug', [
        'as' => 'ivehicles.brand.index',
        'uses' => 'PublicController@index',
        //'middleware' => 'can:ivehicles.vehicles.index'
    ]);
    $router->get('{slug}/{vehicles}', [
        'as' => 'ivehicles.vehicles.show',
        'uses' => 'PublicController@show',
        //'middleware' => 'can:ivehicles.vehicles.index'
    ]);

});