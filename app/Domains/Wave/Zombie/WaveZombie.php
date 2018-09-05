<?php

namespace App\Domains\Wave\Zombie;

use App\Domains\Wave\Wave;
use App\Domains\Zombie\Zombie;

class WaveZombie
{
    /**
     * @var Wave
     */
    private $wave;

    /**
     * @var Zombie
     */
    private $zombie;

    /**
     * @var Quantity
     */
    private $quantity;

    /**
     * @param Wave $wave
     * @param Zombie $zombie
     * @param Quantity $quantity
     */
    public function __construct(
        Wave $wave,
        Zombie $zombie,
        Quantity $quantity
    )
    {
        $this->wave = $wave;
        $this->zombie = $zombie;
        $this->quantity = $quantity;
    }

    /**
     * @return Wave
     */
    public function getWave()
    {
        return $this->wave;
    }

    /**
     * @return Zombie
     */
    public function getZombie(): Zombie
    {
        return $this->zombie;
    }

    /**
     * @return Quantity
     */
    public function getQuantity(): Quantity
    {
        return $this->quantity;
    }
}