<?php

use Illuminate\Routing\Router;


$router->group(['prefix' => '/ivehicles'], function (Router $router) {

    $router->group(['prefix' => 'model'], function (Router $router) {
        //Route create
        $router->post('/', [
            'as' => 'api.module.create',
            'uses' => 'ModelController@create',
           // 'middleware' => ['auth:api']
        ]);

        //Route index
        $router->get('/', [
            'as' => 'api.module.get.items.by',
            'uses' => 'ModelController@index',
            //'middleware' => ['auth:api']
        ]);

        //Route show
        $router->get('/{criteria}', [
            'as' => 'api.module.get.item',
            'uses' => 'ModelController@show',
            'middleware' => ['auth:api']
        ]);

        //Route update
        $router->put('/{criteria}', [
            'as' => 'api.module.update',
            'uses' => 'ModelController@update',
            'middleware' => ['auth:api']
        ]);

        //Route delete
        $router->delete('/{criteria}', [
            'as' => 'api.module.delete',
            'uses' => 'ModelController@delete',
            'middleware' => ['auth:api']
        ]);
    });
    $router->group(['prefix' => 'brand'], function (Router $router) {
        //Route create
        $router->post('/', [
            'as' => 'api.brand.create',
            'uses' => 'BrandController@create',
            'middleware' => ['auth:api']
        ]);

        //Route index
        $router->get('/', [
            'as' => 'api.brand.get.items.by',
            'uses' => 'BrandController@index',
            //'middleware' => ['auth:api']
        ]);

        //Route show
        $router->get('/{criteria}', [
            'as' => 'api.brand.get.item',
            'uses' => 'BrandController@show',
            'middleware' => ['auth:api']
        ]);

        //Route update
        $router->put('/{criteria}', [
            'as' => 'api.brand.update',
            'uses' => 'BrandController@update',
            'middleware' => ['auth:api']
        ]);

        //Route delete
        $router->delete('/{criteria}', [
            'as' => 'api.brand.delete',
            'uses' => 'BrandController@delete',
            'middleware' => ['auth:api']
        ]);
    });
});