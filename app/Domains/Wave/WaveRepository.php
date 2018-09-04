<?php

namespace App\Domains\Wave;

use Illuminate\Support\Collection;

class WaveRepository
{
    /**
     * @var WaveFactory
     */
    private $waveFactory;

    /**
     * @param WaveFactory $waveFactory
     */
    public function __construct(
        WaveFactory $waveFactory
    )
    {
        $this->waveFactory = $waveFactory;
    }

    /**
     * @param WaveID $waveID
     * @return Wave | null
     */
    public function find(
        WaveID $waveID
    ): ?Wave
    {
        $waveEloquent = \App\Wave::query()->where('id', $waveID->getValue())->first();

        if (is_null($waveEloquent)) return null;
        return $this->waveFactory->makeByEloquent($waveEloquent);
    }

    /**
     * @param Wave $wave
     * @return WaveID
     */
    public function persist(
        Wave $wave
    ): WaveID
    {
        $eloquent = \App\Wave::unguarded(function () use ($wave) {
            return \App\Wave::query()->updateOrCreate(
                [
                    'id' => !is_null($wave->getId()->getValue()) ? $wave->getId()->getValue() : null
                ],
                [
                    'name' => $wave->getName()->getValue()
                ]
            );
        });

        return new WaveID($eloquent->id);
    }

    /**
     * @return Wave[] | Collection
     */
    public function all(): Collection
    {
        $waveEloquents = \App\Wave::query()->get();
        return collect($waveEloquents)->map(function (\App\Wave $eloquent) {
            return $this->waveFactory->makeByEloquent($eloquent);
        });
    }

    /**
     * @param Wave $wave
     * @return mixed
     */
    public function remove(Wave $wave)
    {
        \App\Wave::destroy($wave->getID()->getValue());

        \App\Wave::query()->where('wave_id', $wave->getID()->getValue())->delete();
    }
}