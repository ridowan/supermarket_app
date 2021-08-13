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

// $router->get('/key', function() {
// 	return \Illuminate\Support\Str::random(32);
// });

$router->get('/', function () use ($router) {
	return $router->app->version();
});


$router->group(['prefix' => 'auth'], function () use ($router) 
{
	$router->post('login', 'AuthController@login');
	$router->get('product/list', 'ProductsController@index');
	$router->post('product/store', 'ProductsController@store');
	// $router->post('product/update', 'ProductsController@update');
	// $router->post('product/approve', 'ProductsController@approve');
	// $router->post('product/reject', 'ProductsController@reject');
});
