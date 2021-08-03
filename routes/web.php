<?php

/** @var \Laravel\Lumen\Routing\Router $router */

use App\Http\Controllers\SeriesControllers;

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

$router->group(['prefix' => 'api'], function () use ($router) {

    $router->get('/', function () use ($router) {
        return $router->app->version();
    });

    $router->group(['prefix' => 'series'], function () use ($router) {
        $router->get('', 'SeriesControllers@index');
        $router->post('', 'SeriesControllers@store');
        $router->get('{id}', 'SeriesControllers@show');
        $router->put('{id}', 'SeriesControllers@update');
        $router->delete('{id}', 'SeriesControllers@destroy');
    });

    $router->group(['prefix' => 'episodeos'], function () use ($router) {
        $router->get('', 'EpisodeosController@index');
    });
});
