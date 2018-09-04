<?php
use Illuminate\Routing\Router;

/** @var Router $router */
Route::get('zombies', 'ZombieController@index')->name('admin.zombie.list');
Route::get('zombies/create', 'ZombieController@getCreate')->name('admin.zombie.create');
Route::post('zombies/create', 'ZombieController@postCreate')->name('admin.zombie.post.create');
Route::get('zombies/{zombieID}/update', 'ZombieController@getUpdate')->name('admin.zombie.get.update');
Route::post('zombies/{zombieID}/update', 'ZombieController@postUpdate')->name('admin.zombie.post.update');
Route::get('zombies/{zombieID}/delete', 'ZombieController@delete')->name('admin.zombie.delete');