<?php

namespace App\Domains\Wave;

class WaveFactory
{
    /**
     * @param Name $name
     * @param WaveID $waveID
     * @return Wave
     */
    public function make(
        Name $name,
        WaveID $waveID
    )
    {
        return new Wave(
            $name,
            $waveID
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
        return new Wave(
            new Name($eloquent->name),
            new WaveID($eloquent->id)
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
            $waveId
        );
    }
}