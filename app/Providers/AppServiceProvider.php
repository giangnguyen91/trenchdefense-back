<?php

namespace App\Providers;

use App\Components\Auth\AuthComponent;
use App\Components\Auth\IAuthComponent;
use App\Components\User\IUserComponent;
use App\Components\User\UserComponent;
use App\Components\Weapon\IWeaponComponent;
use App\Components\Weapon\WeaponComponent;
use App\Domains\Weapon\Master\IWeaponRepository;
use App\Domains\Weapon\Master\WeaponRepository;
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
        $this->app->singleton(AuthComponent::class);
        $this->app->bind(IWeaponRepository::class, WeaponRepository::class);
        $this->app->bind(IWeaponComponent::class, WeaponComponent::class);
    }

    /**
     * @inheritDoc
     */
    public function provides()
    {
        return [
            AuthComponent::class
        ];
    }
}
