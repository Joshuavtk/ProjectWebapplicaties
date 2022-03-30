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

$router->group(['prefix' => 'authentication','middleware' => ['throttle:10,1']], function () use ($router){
    $router->post('/', 'Authentication\AuthenticateController@basic');
    $router->group(['middleware' => ['auth']], function () use ($router) {
        $router->get('/jwt', 'Authentication\AuthenticateController@jwt');
    });
});

/**
 * @Ratelimiting 1 times a minute
 */
//$router->group(['prefix' => 'users', 'middleware' => ['throttle:1000,1']], function () use ($router) {
//    //register new device and update
//    //todo Security only our app should post
//    $router->post('/', '@create');
//    $router->put('/{id}', 'DevicesController@update');
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

$router->post('/sendWeatherData', 'WeatherStationsController@receive');
$router->get('/getWeatherData', 'WeatherStationsController@get');
