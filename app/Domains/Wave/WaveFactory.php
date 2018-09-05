<?php

namespace App\Domains\Wave;

use App\Domains\Base\ResourceID;
use App\Domains\Wave\Zombie\WaveZombie;
use App\Domains\Wave\Zombie\WaveZombieRepository;
use Illuminate\Support\Collection;

class WaveFactory
{
    /**
     * @param Name $name
     * @param WaveID $waveID
     * @param ResourceID $resourceID
     * @param Collection | WaveZombie[] $waveZombies | null
     * @return Wave
     */
    public function make(
        Name $name,
        WaveID $waveID,
        ResourceID $resourceID,
        Collection $waveZombies = null
    )
    {
        return new Wave(
            $name,
            $waveID,
            $resourceID,
            $waveZombies
        );
    }

    /**
     * @param \App\Wave $eloquent
     * @param WaveZombieRepository $waveZombieRepository
     * @return Wave
     */
    public function makeByEloquent(
        \App\Wave $eloquent,
        WaveZombieRepository $waveZombieRepository
    )
    {
        $waveZombie = $waveZombieRepository->findByWaveID(new WaveID($eloquent->id));
        return $this->make(
            new Name($eloquent->name),
            new WaveID($eloquent->id),
            new ResourceID($eloquent->resource_id),
            $waveZombie
        );
    }

    /**
     * @param array $array
     * @return Wave
     */
    public function makeByArray(
        array $array
    )
    {
        $waveId = !empty($array['id']) ? new WaveID($array['id']) : new WaveID(null);
        return new Wave(
            new Name($array['name']),
            $waveId,
            new ResourceID($array['resource_id'])
        );
    }
}