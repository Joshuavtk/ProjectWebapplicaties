<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(['prefix' => 'authentication'], function () use ($router) {
    $router->post('/', 'Authentication\AuthenticateController@basic');
    $router->post('/register', 'Authentication\RegisterController@register');
    $router->post('/{id}/Verify', 'Authentication\RegisterController@Verify');

    $router->group(['middleware' => ['auth']], function () use ($router) {
        $router->get('/jwt', 'Authentication\AuthenticateController@jwt');
    });
});

$router->group(['prefix' => 'users', 'middleware' => ['auth']], function () use ($router) {
    $router->get('/', 'UsersController@view');
    $router->post('/', 'UsersController@update');
    $router->delete('/delete', 'UsersController@delete');

    $router->group(['prefix' => '/admin'], function () use ($router) {
        $router->get('/', 'Admin\UsersController@index');
        $router->get('/trashed', 'Admin\UsersController@trashed');
        $router->get('/{id}', 'Admin\UsersController@view');
        $router->post('/', 'Admin\UsersController@create');
        $router->put('/', 'Admin\UsersController@update');
        $router->post('/{id}/restore', 'Admin\UsersController@restore');
        $router->delete('/{id}/delete', 'Admin\UsersController@forceDelete');
        $router->delete('/{id}/force-delete', 'Admin\UsersController@forceDelete');
    });
});
//
$router->group(['prefix' => 'maintenances', 'middleware' => ['auth']], function () use ($router) {
    $router->get('/{id}', 'MaintenancesController@view');
    $router->post('/{id}', 'MaintenancesController@update');
    $router->delete('/{id}/delete', 'MaintenancesController@delete');

    $router->group(['prefix' => '/admin', 'middleware' => ['auth']], function () use ($router) {
        $router->get('/', 'Admin\MaintenancesController@index');
        $router->get('/trashed', 'Admin\MaintenancesController@trashed');
        $router->get('/{id}', 'Admin\MaintenancesController@view');
        $router->post('/', 'Admin\MaintenancesController@create');
        $router->put('/', 'Admin\MaintenancesController@update');
        $router->post('/{id}/restore', 'Admin\MaintenancesController@restore');
        $router->delete('/{id}/delete', 'Admin\MaintenancesController@forceDelete');
        $router->delete('/{id}/force-delete', 'Admin\MaintenancesController@forceDelete');
    });
});


//$router->group(['prefix' => 'maintenances', 'middleware' => ['throttle:1000,1']], function () use ($router) {
//
//
//    $router->group(['prefix' => '/admin', 'middleware' => ['auth']], function () use ($router) {
//        $router->get('/', 'Admin\UsersController@index');
//        $router->get('/{id}', 'Admin\UsersController@view');
//        $router->post('/', 'Admin\UsersController@create');
//        $router->put('/', 'Admin\UsersController@update');
//        $router->get('/trashed', 'Admin\UsersController@trashed');
//        $router->post('/{id}/restore', 'Admin\UsersController@restore');
//        $router->delete('/{id}/delete', 'Admin\UsersController@forceDelete');
//        $router->delete('/{id}/force-delete', 'Admin\UsersController@forceDelete');
//    });
//});
$router->group(['prefix' => 'weather'], function () use ($router) {
    $router->post('/', 'WeatherStationsController@create');
    //$router->get('/', 'WeatherStationsController@index');
});

$router->post('/sendWeatherData', 'WeatherStationsController@receive');
