<?php

/** @var \Laravel\Lumen\Routing\Router $router */

$router->group(['middleware' => 'auth:web'], function (\Laravel\Lumen\Routing\Router $router) {

    $router->get('/', '\App\Pages\Home@view');

    $router->get('/projects/create', 'ProjectController@create');
    $router->post('/projects', 'ProjectController@store');
    $router->get('/projects', 'ProjectController@index');

    $router->get('/hosts/types', 'HostTypeController@index');
    $router->get('/hosts/types/create', 'HostTypeController@create');
    $router->post('/hosts/types', 'HostTypeController@store');

    $router->get('/hosts/create', 'HostController@create');
    $router->post('/hosts', 'HostController@store');
    $router->get('/hosts', 'HostController@index');
    $router->post('/hosts/{host}/raw-command', 'HostController@rawCommand');
    $router->get('/hosts/{host}/pull', 'HostController@pull');
    $router->get('/hosts/{host}/destroy', 'HostController@destroy');
    $router->get('/hosts/{host}', 'HostController@show');
    $router->get('/hosts/{host}/env', 'HostController@editEnv');
    $router->post('/hosts/{host}/env', 'HostController@updateEnv');

    $router->get('/commands', 'CommandController@index');
    $router->get('/commands/create', 'CommandController@create');
    $router->post('/commands', 'CommandController@store');

    $router->get('/databases/', 'DatabaseController@index');
    $router->post('/databases/', 'DatabaseController@store');
    $router->get('/databases/create', 'DatabaseController@create');

    $router->get('/databases/connections/', 'DbConnectionController@index');
    $router->get('/databases/connections/create', 'DbConnectionController@create');
    $router->post('/databases/connections', 'DbConnectionController@store');

    $router->get('/logout', 'AuthController@logout');
});

$router->post('/login', 'AuthController@login');
$router->get('/auth', 'AuthController@auth');
