<?php
use Illuminate\Routing\Router;

/** @var Router $router */
$router->group(['prefix'=> 'zombies'], function (Router $router) {
    $router->get('/', 'ZombieController@index')->name('admin.zombie.list');
    $router->get('/create', 'ZombieController@getCreate')->name('admin.zombie.create');
    $router->post('/create', 'ZombieController@postCreate')->name('admin.zombie.post.create');
    $router->get('/{zombieID}/update', 'ZombieController@getUpdate')->name('admin.zombie.get.update');
    $router->post('/{zombieID}/update', 'ZombieController@postUpdate')->name('admin.zombie.post.update');
    $router->get('/{zombieID}/delete', 'ZombieController@delete')->name('admin.zombie.delete');
});

$router->group(['prefix'=> 'waves'], function (Router $router) {
    $router->get('/', 'WaveController@index')->name('admin.wave.index');
    $router->get('create', 'WaveController@getCreate')->name('admin.wave.create');
    $router->post('create', 'WaveController@postCreate')->name('admin.wave.post.create');
    $router->get('{waveID}/update', 'WaveController@getUpdate')->name('admin.wave.get.update');
    $router->post('{waveID}/update', 'WaveController@postUpdate')->name('admin.wave.post.update');
    $router->get('{waveID}/delete', 'WaveController@delete')->name('admin.wave.delete');
});