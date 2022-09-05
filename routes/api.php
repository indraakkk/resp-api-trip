<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
// public route
Route::post('/register', 'AuthController@register');
Route::post('/login', 'AuthController@login');

// protected route
Route::group(['middleware' => ['auth:sanctum']], function(){
    Route::post('/logout', 'AuthController@logout');
    Route::group(['prefix' => 'trip'], function(){
        Route::get('/', 'TripController@index');
        Route::post('/create', 'TripController@create');
        Route::put('/update', 'TripController@update');
        Route::delete('/delete/{id}', 'TripController@delete');
        Route::get('/type_of_trip', 'TripController@type');
    });

});
