<?php

namespace App\Providers;

use App\Components\Auth\AuthComponent;
use App\Components\Auth\IAuthComponent;
use App\Components\User\IUserComponent;
use App\Components\User\UserComponent;
use App\Components\Weapon\IWeaponComponent;
use App\Components\Weapon\WeaponComponent;
use App\Components\Zombie\IZombieComponent;
use App\Components\Zombie\ZombieComponent;
use App\Domains\Weapon\Master\IWeaponRepository;
use App\Domains\Weapon\Master\WeaponRepository;
use App\Domains\Zombie\Master\IZombieRepository;
use App\Domains\Zombie\Master\ZombieRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(IWeaponRepository::class, WeaponRepository::class);
        $this->app->bind(IWeaponComponent::class, WeaponComponent::class);

        // Zombie.
        $this->app->bind(IZombieRepository::class, ZombieRepository::class);
        $this->app->bind(IZombieComponent::class, ZombieComponent::class);
    }
}
