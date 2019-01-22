<?php
use Illuminate\Routing\Router;

/** @var Router $router */
$router->get('/', 'AdminController@index')->name('admin.index');


$router->group(['prefix' => 'reset'], function (Router $router) {
    $router->get('/masterdata', 'AdminController@getResetMasterData')->name('admin.reset.masterdata.index');
    $router->post('/masterdata', 'AdminController@resetMasterData')->name('admin.reset.masterdata')->middleware("throttle:1");
});


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

$router->group(['prefix'=> 'characters'], function (Router $router) {
    $router->get('/', 'CharacterController@index')->name('admin.character.list');
    $router->get('/create', 'CharacterController@getCreate')->name('admin.character.create');
    $router->post('/create', 'CharacterController@postCreate')->name('admin.character.post.create');
    $router->get('/{characterID}/update', 'CharacterController@getUpdate')->name('admin.character.get.update');
    $router->post('/{characterID}/update', 'CharacterController@postUpdate')->name('admin.character.post.update');
    $router->get('/{characterID}/delete', 'CharacterController@delete')->name('admin.character.delete');

    $router->get('/having', 'HavingCharacterController@index')->name('admin.having_character.list');
    $router->post('/having', 'HavingCharacterController@addNew')->name('admin.having_character.add');
});

$router->group(['prefix'=> 'weapons'], function (Router $router) {
    $router->group(['prefix'=> 'group'], function (Router $router) {
        $router->get('/', 'WeaponGroupController@index')->name('admin.weapon.group.list');
        $router->get('/create', 'WeaponGroupController@getCreate')->name('admin.weapon.group.create');
        $router->post('/create', 'WeaponGroupController@postCreate')->name('admin.weapon.group.post.create');
        $router->get('/{weaponGroupID}/update', 'WeaponGroupController@getUpdate')->name('admin.weapon.group.get.update');
        $router->post('/{weaponGroupID}/update', 'WeaponGroupController@postUpdate')->name('admin.weapon.group.post.update');
        $router->get('/{weaponGroupID}/delete', 'WeaponGroupController@delete')->name('admin.weapon.group.delete');
    });

    $router->get('/', 'WeaponController@index')->name('admin.weapon.list');
    $router->get('/create', 'WeaponController@getCreate')->name('admin.weapon.create');
    $router->post('/create', 'WeaponController@postCreate')->name('admin.weapon.post.create');
    $router->get('/{weaponID}/update', 'WeaponController@getUpdate')->name('admin.weapon.get.update');
    $router->post('/{weaponID}/update', 'WeaponController@postUpdate')->name('admin.weapon.post.update');
    $router->get('/{weaponID}/delete', 'WeaponController@delete')->name('admin.weapon.delete');
});