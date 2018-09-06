<?php

namespace App\Domains\Wave;

use App\Domains\Wave\Zombie\WaveZombie;
use App\Utils\Paginator;
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
                    'name' => $wave->getName()->getValue(),
                    'resource_id' => $wave->getResourceID()->getValue()
                ]
            );
        });

        if ($wave->getID()->getValue()) {
            $this->removeWaveZombie($wave);
        }

        $waveZombies = $wave->getWaveZombies();

        foreach ($waveZombies as $waveZombie){
            $this->persistWaveZombie($waveZombie);
        }

        return new WaveID($eloquent->id);
    }

    public function persistWaveZombie(WaveZombie $waveZombie)
    {
        \App\WaveZombie::unguarded(function () use ($waveZombie) {
            return \App\WaveZombie::query()->updateOrCreate(
                [
                    'wave_id' => $waveZombie->getWaveID()->getValue(),
                    'zombie_id' => $waveZombie->getZombie()->getID()->getValue(),
                    'quantity' => $waveZombie->getQuantity()->getValue()
                ]
            );
        });
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
        $this->removeWaveZombie($wave);
    }

    /**
     * @param Wave $wave
     * @return mixed
     */
    public function removeWaveZombie(Wave $wave)
    {
        \App\WaveZombie::query()->where('wave_id', $wave->getID()->getValue())->delete();
    }

    /**
     * @param int $page
     * @param int $perPage
     * @return Paginator
     */
    public function paginate(
        int $page,
        int $perPage
    ): Paginator
    {
        $eloquent = \App\Wave::query();

        $pagination = Paginator::fromQueryBuilder($eloquent, $perPage, $page);

        return $pagination->map(function (\App\Wave $eloquent) {
            return $this->waveFactory->makeByEloquent($eloquent);
        });
    }
}