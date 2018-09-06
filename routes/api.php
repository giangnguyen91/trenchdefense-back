<?php

use Illuminate\Http\Request;
use Illuminate\Routing\Router;
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

Route::group(['middleware' => ['auth:api'],'prefix' => 'waves'], function (Router $router) {
    Route::get('/{page}', 'WaveController@get');
});


Route::group(['middleware' => ['auth:api'],'prefix' => 'characters'], function (Router $router) {
    Route::get('/having', 'HavingCharacterController@getByGameUserID');
});


