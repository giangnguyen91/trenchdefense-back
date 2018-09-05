<?php

namespace App\Components\Wave;

use App\Domains\Wave\Wave;
use App\Domains\Wave\WaveID;
use App\Domains\Wave\WaveRepository;
use Illuminate\Support\Collection;

class WaveComponent
{
    /**
     * @var WaveRepository
     */
    private $waveRepository;

    /**
     * @param WaveRepository $waveRepository
     */
    public function __construct(
        WaveRepository $waveRepository
    )
    {
        $this->waveRepository = $waveRepository;
    }

    /**
     * @return Wave[] | Collection
     */
    public function getAllWave(): Collection
    {
        return $this->waveRepository->all();
    }

    /**
     * @param Wave $wave
     * @return WaveID
     */
    public function addNewWave(Wave $wave): WaveID
    {
        return $this->waveRepository->persist($wave);
    }

    /**
     * @param WaveID $waveID
     * @return Wave
     */
    public function get(WaveID $waveID): Wave
    {
        return $this->waveRepository->find($waveID);
    }

    /**
     * @param Wave $wave
     * @return mixed
     */
    public function remove(Wave $wave)
    {
        return $this->waveRepository->remove($wave);
    }
}