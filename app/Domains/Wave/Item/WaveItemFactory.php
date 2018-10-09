<?php

namespace App\Domains\Wave\Item;

use App\Domains\Item\Master\ItemID;
use App\Domains\Wave\WaveID;

class WaveItemFactory
{
    /**
     * @param ItemID $itemID
     * @param Count $count
     * @param WaveID $waveID
     * @return WaveItem
     */
    public function make(
        ItemID $itemID,
        Count $count,
        WaveID $waveID
    )
    {
        return new WaveItem($itemID, $count, $waveID);
    }

    /**
     * @return WaveItem
     */
    public function makeByEloquent(\App\WaveItem $eloquent): WaveItem
    {
        return $this->make(
            new ItemID($eloquent->item_id),
            new Count($eloquent->count),
            new WaveID($eloquent->wave_id)
        );
    }
}