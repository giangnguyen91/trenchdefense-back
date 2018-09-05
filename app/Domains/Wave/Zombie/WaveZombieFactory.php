<?php

namespace App\Domains\Wave\Zombie;

use App\Domains\Wave\Wave;
use App\Domains\Wave\WaveID;
use App\Domains\Wave\WaveRepository;
use App\Domains\Zombie\Zombie;
use App\Domains\Zombie\ZombieID;
use App\Domains\Zombie\ZombieRepository;
use Illuminate\Support\Collection;

class WaveZombieFactory
{
    /**
     * @param Wave $wave
     * @param Zombie $zombie
     * @param Quantity $quantity
     * @return WaveZombie
     */
    public function make(
        Wave $wave,
        Zombie $zombie,
        Quantity $quantity
    )
    {
        return new WaveZombie(
            $wave,
            $zombie,
            $quantity
        );
    }


    /**
     * @param \App\WaveZombie $eloquent
     * @param ZombieRepository $zombieRepository
     * @param WaveRepository $waveRepository
     * @return WaveZombie
     */
    public function makeByEloquent(
        \App\WaveZombie $eloquent,
        ZombieRepository $zombieRepository,
        WaveRepository $waveRepository
    )
    {
        $wave = $waveRepository->find(new WaveID($eloquent->wave_id));
        $zombie = $zombieRepository->find(new ZombieID($eloquent->zombie_id));

        return new WaveZombie(
            $wave,
            $zombie,
            new Quantity($eloquent->quantity)
        );
    }

    /**
     * @param array $array
     * @param ZombieRepository $zombieRepository
     * @param WaveRepository $waveRepository
     * @return WaveZombie
     */
    public function makeByArray(
        array $array,
        ZombieRepository $zombieRepository,
        WaveRepository $waveRepository
    )
    {
        $wave = $waveRepository->find(new WaveID($array['wave_id']));
        $zombie = $zombieRepository->find(new ZombieID($array['zombie_id']));

        return new WaveZombie(
            $wave,
            $zombie,
            new Quantity($array['quantity'])
        );
    }
}