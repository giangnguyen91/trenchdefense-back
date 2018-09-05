<?php

namespace App\Components\Wave;

use App\Domains\Wave\Wave;
use App\Domains\Wave\Zombie\WaveZombie;
use App\Domains\Wave\Zombie\WaveZombieRepository;
use Illuminate\Support\Collection;

class WaveZombieComponent
{
    /**
     * @var WaveZombieRepository
     */
    private $waveZombieRepository;

    /**
     * @param WaveZombieRepository $waveZombieRepository
     */
    public function __construct(
        WaveZombieRepository $waveZombieRepository
    )
    {
        $this->waveZombieRepository = $waveZombieRepository;
    }


    /**
     * @param Wave $wave
     * @return Collection | WaveZombie[]
     */
    public function getByWave(Wave $wave): Collection
    {
        return $this->waveZombieRepository->findByWaveID($wave->getID());
    }

    /**
     * @param Wave $wave
     * @return mixed
     */
    public function removeByWave(Wave $wave)
    {
        return $this->waveZombieRepository->removeByWave($wave);
    }

    /**
     * @param WaveZombie $waveZombie
     * @return mixed
     */
    public function persist(WaveZombie $waveZombie)
    {
        return $this->waveZombieRepository->persist($waveZombie);
    }
}