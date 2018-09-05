<?php

namespace App\Domains\Wave\Zombie;

use App\Domains\Wave\Wave;
use App\Domains\Wave\WaveID;
use App\Domains\Wave\WaveRepository;
use App\Domains\Zombie\ZombieRepository;
use Illuminate\Support\Collection;

class WaveZombieRepository
{
    /**
     * @var WaveZombieFactory
     */
    private $waveZombieFactory;

    /**
     * @var ZombieRepository
     */
    private $zombieRepository;

    /**
     * @var WaveRepository
     */
    private $waveRepository;

    /**
     * @param WaveZombieFactory $waveZombieFactory
     * @param ZombieRepository $zombieRepository
     * @param WaveRepository $waveRepository
     */
    public function __construct(
        WaveZombieFactory $waveZombieFactory,
        ZombieRepository $zombieRepository,
        WaveRepository $waveRepository
    )
    {
        $this->waveZombieFactory = $waveZombieFactory;
        $this->zombieRepository = $zombieRepository;
        $this->waveRepository = $waveRepository;
    }

    /**
     * @param WaveID $waveID
     * @return Collection | WaveZombie[]
     */
    public function findByWaveID(
        WaveID $waveID
    ): Collection
    {
        $waveZombiesEloquent = \App\WaveZombie::query()->where('wave_id', $waveID->getValue())->get();
        return collect($waveZombiesEloquent)->map(function (\App\WaveZombie $eloquent) {
            return $this->waveZombieFactory->makeByEloquent($eloquent, $this->zombieRepository, $this->waveRepository);
        });
    }


    /**
     * @param WaveZombie $waveZombie
     * @return mixed
     */
    public function persist(
        WaveZombie $waveZombie
    )
    {
        \App\WaveZombie::unguarded(function () use ($waveZombie) {
            return \App\WaveZombie::query()->updateOrCreate(
                [
                    'wave_id' => $waveZombie->getWave()->getID()->getValue(),
                    'zombie_id' => $waveZombie->getZombie()->getID()->getValue(),
                    'quantity' => $waveZombie->getQuantity()->getValue()
                ]
            );
        });
    }

    /**
     * @param Wave $wave
     * @return mixed
     */
    public function removeByWave(Wave $wave)
    {
        \App\WaveZombie::query()->where('wave_id', $wave->getID()->getValue())->delete();
    }
}