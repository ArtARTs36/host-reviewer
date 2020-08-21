<?php

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

use Illuminate\Support\Facades\Cache;

/** @var \Laravel\Lumen\Routing\Router $router */

$router->get('/', '\App\Pages\Home@view');

$router->get('/projects/create', 'ProjectController@create');
$router->post('/projects', 'ProjectController@store');
$router->get('/projects', 'ProjectController@index');

$router->get('/hosts/create', 'HostController@create');
$router->post('/hosts', 'HostController@store');
$router->get('/hosts', 'HostController@index');
$router->get('/hosts/{host}/pull', 'HostController@pull');

