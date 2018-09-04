<?php
use Illuminate\Routing\Router;

/** @var Router $router */
Route::get('zombies', 'ZombieController@index');