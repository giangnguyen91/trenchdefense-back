<?php

namespace App\Domains\Wave\Zombie;

use App\Domains\Wave\Wave;
use App\Domains\Wave\WaveFactory;
use App\Domains\Wave\WaveID;
use App\Domains\Wave\WaveRepository;
use App\Domains\Zombie\Zombie;
use App\Domains\Zombie\ZombieFactory;
use App\Domains\Zombie\ZombieID;
use App\Domains\Zombie\ZombieRepository;

class WaveZombieFactory
{
    private $zombieFactory;

    public function __construct(
        ZombieFactory $zombieFactory
    )
    {
        $this->zombieFactory = $zombieFactory;
    }

    /**
     * @param Zombie $zombie
     * @param Quantity $quantity
     * @param WaveID $waveID
     * @return WaveZombie
     */
    public function make(
        Zombie $zombie,
        Quantity $quantity,
        WaveID $waveID
    )
    {
        return new WaveZombie(
            $zombie,
            $quantity,
            $waveID
        );
    }


    /**
     * @param \App\WaveZombie $eloquent
     * @return WaveZombie
     */
    public function makeByEloquent(
        \App\WaveZombie $eloquent
    )
    {
        $zombie = $this->zombieFactory->makeByEloquent($eloquent->zombie);

        return $this->make(
            $zombie,
            new Quantity($eloquent->quantity),
            new WaveID($eloquent->wave_id)
        );
    }

    /**
     * @param array $array
     * @param ZombieRepository $zombieRepository
     * @return WaveZombie
     */
    public function makeByArray(
        array $array,
        ZombieRepository $zombieRepository
    )
    {
        $zombie = $zombieRepository->find(new ZombieID($array['zombie_id']));

        return $this->make(
            $zombie,
            new Quantity($array['quantity']),
            $array['wave_id']
        );
    }
}