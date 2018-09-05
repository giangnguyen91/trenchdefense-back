<?php
use Illuminate\Routing\Router;

/** @var Router $router */
Route::get('zombies', 'ZombieController@index')->name('admin.zombie.list');
Route::get('zombies/create', 'ZombieController@getCreate')->name('admin.zombie.create');
Route::post('zombies/create', 'ZombieController@postCreate')->name('admin.zombie.post.create');
Route::get('zombies/{zombieID}/update', 'ZombieController@getUpdate')->name('admin.zombie.get.update');
Route::post('zombies/{zombieID}/update', 'ZombieController@postUpdate')->name('admin.zombie.post.update');
Route::get('zombies/{zombieID}/delete', 'ZombieController@delete')->name('admin.zombie.delete');


$router->group(['prefix'=> 'waves'], function (Router $router) {
    $router->get('/', 'WaveController@index')->name('admin.wave.index');
    Route::get('create', 'WaveController@getCreate')->name('admin.wave.create');
    Route::post('create', 'WaveController@postCreate')->name('admin.wave.post.create');
    Route::get('{waveID}/update', 'WaveController@getUpdate')->name('admin.wave.get.update');
    Route::post('{waveID}/update', 'WaveController@postUpdate')->name('admin.wave.post.update');
    Route::get('{waveID}/delete', 'WaveController@delete')->name('admin.wave.delete');
});