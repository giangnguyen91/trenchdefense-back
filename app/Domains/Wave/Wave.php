<?php

namespace App\Domains\Wave;

use Illuminate\Support\Collection;

class Wave
{
    /**
     * @var Name
     */
    private $name;

    /**
     * @var WaveID
     */
    private $waveID;

    /**
     * @param Name $name
     * @param WaveID $waveID
     */
    public function __construct(
        Name $name,
        WaveID $waveID
    )
    {
        $this->name = $name;
        $this->waveID = $waveID;
    }

    /**
     * @return Name
     */
    public function getName(): Name
    {
        return $this->name;
    }

    /**
     * @return WaveID
     */
    public function getID(): WaveID
    {
        return $this->waveID;
    }
}