<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;

$router->group(['prefix' => 'api'], function () use ($router) {
    $router->get('/users', 'UserController@index');
    $router->post('/users', 'UserController@store');
    $router->post('/auth/login', 'AuthController@login');
});

$router->get('/test', function () {
    return response()->json(['message' => 'Test route is working!'], 200);
});
