<?php

namespace App\Domains\Wave\Item;

use App\Domains\Item\Master\ItemID;
use App\Domains\Wave\WaveID;
use App\Domains\Zombie\Zombie;

class WaveItem
{
    /**
     * @var ItemID
     */
    private $itemID;

    /**
     * @var Count
     */
    private $count;

    /**
     * @var WaveID
     */
    private $waveID;

    /**
     * @param ItemID $itemID
     * @param Count $count
     * @param WaveID $waveID
     */
    public function __construct(
        ItemID $itemID,
        Count $count,
        WaveID $waveID
    )
    {
        $this->itemID = $itemID;
        $this->count = $count;
        $this->waveID = $waveID;
    }

    /**
     * @return Count
     */
    public function getCount(): Count
    {
        return $this->count;
    }

    /**
     * @return ItemID
     */
    public function getItemID(): ItemID
    {
        return $this->itemID;
    }

    /**
     * @return WaveID
     */
    public function getWaveID(): WaveID
    {
        return $this->waveID;
    }

    /**
     * @return \App\Proto\WaveItem
     */
    public function toProtobuf(): \App\Proto\WaveItem
    {
        $proto = new \App\Proto\WaveItem();
        $proto->itemID = $this->getItemID()->getValue();
        $proto->count = $this->getCount()->getValue();
        return $proto;
    }
}