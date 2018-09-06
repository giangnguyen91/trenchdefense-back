<?php

namespace App\Providers;

use App\Components\Wave\WaveComponent;
use App\Components\Zombie\ZombieComponent;
use App\Domains\Wave\WaveFactory;
use App\Domains\Wave\WaveRepository;
use App\Domains\Wave\Zombie\WaveZombieFactory;
use App\Domains\Zombie\ZombieFactory;
use App\Domains\Zombie\ZombieRepository;
use Illuminate\Support\ServiceProvider;

class AdminServiceProvider extends ServiceProvider
{
    /** @var bool */
    protected $defer = true;

    /**
     * @inheritDoc
     */
    public function register()
    {
        $this->app->singleton(ZombieFactory::class);
        $this->app->singleton(ZombieRepository::class);
        $this->app->singleton(ZombieComponent::class);
        $this->app->singleton(WaveZombieFactory::class);
        $this->app->singleton(WaveFactory::class);
        $this->app->singleton(WaveRepository::class);
    }

    /**
     * @inheritDoc
     */
    public function provides()
    {
        return [
            ZombieFactory::class,
            ZombieRepository::class,
            ZombieComponent::class,
            WaveZombieFactory::class,
            WaveZombieRepository::class,
            WaveFactory::class,
            WaveRepository::class,
            WaveZombieComponent::class,
            WaveComponent::class
        ];
    }
}
