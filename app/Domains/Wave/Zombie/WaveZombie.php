<?php

namespace App\Domains\Wave\Zombie;

use App\Domains\Wave\WaveID;
use App\Domains\Zombie\Zombie;
use App\Utils\Util;

class WaveZombie
{
    /**
     * @var Zombie
     */
    private $zombie;

    /**
     * @var Quantity
     */
    private $quantity;

    /**
     * @var WaveID
     */
    private $waveID;

    /**
     * @param Zombie $zombie
     * @param Quantity $quantity
     * @param WaveID $waveID
     */
    public function __construct(
        Zombie $zombie,
        Quantity $quantity,
        WaveID $waveID
    )
    {
        $this->zombie = $zombie;
        $this->quantity = $quantity;
        $this->waveID = $waveID;
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

    /**
     * @return WaveID
     */
    public function getWaveID(): WaveID
    {
        return $this->waveID;
    }

    /**
     * @return \App\Proto\WaveZombie
     */
    public function toProtobuf(): \App\Proto\WaveZombie
    {
        $proto = new \App\Proto\WaveZombie();
        $proto->zombie = $this->zombie->toProtobuf();
        $proto->quantity = $this->quantity->getValue();
        return $proto;
    }
}