<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
header('Access-Control-Allow-Origin:  *');
header('Access-Control-Allow-Methods:  POST, GET, OPTIONS, PUT, DELETE');
header('Access-Control-Allow-Headers:  Content-Type, X-Auth-Token, Origin, Authorization');

Route::post('login', 'AuthenticationController@login');

//protected routes
Route::group(['middleware' => 'auth.jwt'], function () {
    Route::get('logout', 'AuthenticationController@logout');
    Route::resource('roles', 'RoleController');
    
    Route::get('/users/getAllStatusUsers', 'UserController@listStatus');
    Route::resource('users', 'UserController');
});

//public routes
Route::get('/categories/selectCategories', 'CategoryController@selectCategories');
Route::resource('categories', 'CategoryController');
Route::resource('music', 'MusicController');
