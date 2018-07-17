<?php

namespace App\Providers;

use App\Components\Auth\AuthComponent;
use App\Components\Auth\IAuthComponent;
use App\Components\User\IUserComponent;
use App\Components\User\UserComponent;
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
        $this->app->bind(IUserComponent::class, UserComponent::class);
        $this->app->bind(IAuthComponent::class, AuthComponent::class);
    }
}
