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

Route::group(['prefix' => 'waves', 'middleware' => 'auth:api'], function (Router $router) {
    $router->get('/{page}', 'WaveController@get');
});

Route::group(['prefix' => 'characters', 'middleware' => 'auth:api'], function (Router $router) {
    $router->get('/having', 'HavingCharacterController@getByGameUserID');
    $router->get('/all', 'CharacterController@get');
});

Route::group(['prefix' => 'weapons', 'middleware' => 'auth:api'], function (Router $router) {
    $router->get('/all', 'WeaponController@get');
});

Route::group(['prefix' => 'user', 'middleware' => 'auth:api'], function (Router $router) {
    $router->get('/', 'SettingController@get');
    $router->post('/setting', 'SettingController@update');
});

Route::group(['prefix' => 'match'], function (Router $router) {
    $router->post('/begin', 'MatchController@begin');
    $router->get('/start', 'MatchController@start');
});