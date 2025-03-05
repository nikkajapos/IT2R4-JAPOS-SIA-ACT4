<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Basic Test Route
$router->get('/', function () {
    return response()->json(['message' => 'Welcome to Lumen API!']);
});

// Route for Users
$router->get('/users', ['uses' => 'UserController@index']);
