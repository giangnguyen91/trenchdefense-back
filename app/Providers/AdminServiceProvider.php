<?php

namespace App\Providers;

use App\Components\Character\CharacterComponent;
use App\Components\Character\HavingCharacterComponent;
use App\Components\Wave\WaveComponent;
use App\Components\Zombie\ZombieComponent;
use App\Domains\Character\CharacterFactory;
use App\Domains\Character\CharacterRepository;
use App\Domains\Character\Having\HavingCharacterFactory;
use App\Domains\Character\Having\HavingCharacterRepository;
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
        $this->app->singleton(CharacterFactory::class);
        $this->app->singleton(CharacterRepository::class);
        $this->app->singleton(CharacterComponent::class);
        $this->app->singleton(HavingCharacterFactory::class);
        $this->app->singleton(HavingCharacterRepository::class);
        $this->app->singleton(HavingCharacterComponent::class);
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
            WaveFactory::class,
            WaveRepository::class,
            WaveComponent::class,
            CharacterFactory::class,
            CharacterRepository::class,
            CharacterComponent::class,
            HavingCharacterFactory::class,
            HavingCharacterRepository::class,
            HavingCharacterComponent::class
        ];
    }
}
