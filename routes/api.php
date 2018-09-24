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

Route::post('/create-access-token', 'GameUserController@createAccessToken');

Route::get('/user', 'GameUserController@getInfo')->middleware('auth:api');

Route::group(['prefix' => 'waves'], function (Router $router) {
    $router->get('/{page}', 'WaveController@get');
});

Route::group(['prefix' => 'characters'], function (Router $router) {
    $router->get('/having', 'HavingCharacterController@getByGameUserID')->middleware('auth:api');
    $router->get('/all', 'CharacterController@get');
});

Route::group(['prefix' => 'weapons'], function (Router $router) {
    $router->get('/all', 'WeaponController@get');
});
 