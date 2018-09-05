<?php

namespace App\Domains\Wave;

use App\Domains\Base\ResourceID;

class WaveFactory
{
    /**
     * @param Name $name
     * @param WaveID $waveID
     * @param ResourceID $resourceID
     * @return Wave
     */
    public function make(
        Name $name,
        WaveID $waveID,
        ResourceID $resourceID
    )
    {
        return new Wave(
            $name,
            $waveID,
            $resourceID
        );
    }

    /**
     * @param \App\Wave $eloquent
     * @return Wave
     */
    public function makeByEloquent(
        \App\Wave $eloquent
    )
    {
        return $this->make(
            new Name($eloquent->name),
            new WaveID($eloquent->id),
            new ResourceID($eloquent->resource_id)
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