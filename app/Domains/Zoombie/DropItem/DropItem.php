<?php

namespace App\Domains\Zoombie\DropItem;

use App\Domains\Item\Master\Item;
use App\Domains\Zombie\DropItem\DropRate;
use App\Domains\Zombie\ZombieID;

class DropItem
{
    /**
     * @var ZombieID
     */
    private $zombieID;

    /**
     * @var Item
     */
    private $item;

    /**
     * @var DropRate
     */
    private $dropRate;

    /**
     * @param ZombieID $zombieID
     * @param Item $item
     * @param DropRate $dropRate
     */
    public function __construct(
        ZombieID $zombieID,
        Item $item,
        DropRate $dropRate
    )
    {
        $this->zombieID = $zombieID;
        $this->item = $item;
        $this->dropRate = $dropRate;
    }

    /**
     * @return ZombieID
     */
    public function getZombieID() : ZombieID
    {
        return $this->zombieID;
    }

    /**
     * @return Item
     */
    public function getItem() : Item
    {
        return $this->item;
    }

    /**
     * @return DropRate
     */
    public function getDropRate() : DropRate
    {
        return $this->dropRate;
    }

    /**
     * @return \App\Proto\DropItem
     */
    public function toProtobuf() : \App\Proto\DropItem
    {
        $model = new \App\Proto\DropItem();
        $model->zombieID = $this->getZombieID()->getValue();
        $model->item = $this->getItem()->toProtobuf();
        $model->dropRate = $this->getDropRate()->getValue();
        return $model;
    }

}