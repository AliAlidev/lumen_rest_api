<?php

/** @var \Laravel\Lumen\Routing\Router $router */

use App\Models\Blog;

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

$router->group(['prefix' => 'api'], function () use ($router) {
    $router->get('posts', 'BlogController@index');
    $router->get('post/{id}', 'BlogController@show');
    $router->put('post/{id}', 'BlogController@put');
    $router->delete('post/{id}', 'BlogController@delete');
    $router->post('post', 'BlogController@store');
});
