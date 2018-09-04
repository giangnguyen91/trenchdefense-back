<?php
namespace App\Providers;

use App\Components\Zombie\ZombieComponent;
use App\Domains\Zombie\ZombieFactory;
use App\Domains\Zombie\ZombieRepository;
use Illuminate\Support\ServiceProvider;

class AdminServiceProvider extends ServiceProvider
{
    /** @var bool  */
    protected $defer = true;

    /**
     * @inheritDoc
     */
    public function register()
    {
        $this->app->singleton(ZombieFactory::class);
        $this->app->singleton(ZombieRepository::class);
        $this->app->singleton(ZombieComponent::class);
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
        ];
    }
}
