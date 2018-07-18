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
Route::post('/access_token', 'AuthenticateController@grantAccessToken');

Route::group(['middleware' => ['auth:api'],'prefix' => 'user'], function (Router $router) {
    $router->get('/myself', "UserController@getMySelf");
    $router->post('/myself/link_social', "UserController@linkSocial");
});
