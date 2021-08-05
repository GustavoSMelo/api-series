<?php

/** @var \Laravel\Lumen\Routing\Router $router */

use App\Http\Controllers\SeriesControllers;

$router->group(['prefix' => 'api', 'middleware' => 'auth'], function () use ($router) {

    $router->get('/', function () use ($router) {
        return $router->app->version();
    });

    $router->group(['prefix' => 'series'], function () use ($router) {
        $router->get('', 'SeriesControllers@index');
        $router->post('', 'SeriesControllers@store');
        $router->get('{id}', 'SeriesControllers@show');
        $router->put('{id}', 'SeriesControllers@update');
        $router->delete('{id}', 'SeriesControllers@destroy');
        $router->get('{id}/episodeos', 'EpisodeosController@perSeries');
    });

    $router->group(['prefix' => 'episodeos'], function () use ($router) {
        $router->get('', 'EpisodeosController@index');
        $router->get('{id}', 'EpisodeosController@show');
        $router->post('', 'EpisodeosController@store');
        $router->put('{id}', 'EpisodeosController@update');
        $router->delete('{id}', 'EpisodeosController@destroy');
    });
});
