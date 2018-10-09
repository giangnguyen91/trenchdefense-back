<?php

namespace App\Domains\Wave\Item;

use App\Domains\Wave\WaveID;
use Illuminate\Support\Collection;

class WaveItemRepository
{
    /**
     * @var WaveItemFactory
     */
    private $waveItemFactory;

    /**
     * @param WaveItemFactory $waveItemFactory
     */
    public function __construct(
        WaveItemFactory $waveItemFactory
    )
    {
        $this->waveItemFactory = $waveItemFactory;
    }

    /**
     * @param WaveID $waveID
     * @return Collection | WaveItem[]
     */
    public function findByWaveID(WaveID $waveID): Collection
    {
        $eloquent = \App\WaveItem::query()->where('wave_id', $waveID->getValue())->get();

        if (is_null($eloquent)) return null;

        return collect($eloquent)->map(function(\App\WaveItem $eloquent){
            return $this->waveItemFactory->makeByEloquent($eloquent);
        });

    }

    /**
     * @param WaveItem $waveItem
     * @return void
     */
    public function persist(WaveItem $waveItem)
    {
        \App\WaveItem::unguarded(function () use ($waveItem) {
            return \App\WaveItem::query()->updateOrCreate(
                [
                    'wave_id' => $waveItem->getWaveID()->getValue(),
                    'item_id' => $waveItem->getItemID()->getValue(),
                    'count' => $waveItem->getCount()->getValue()
                ]
            );
        });
    }
}