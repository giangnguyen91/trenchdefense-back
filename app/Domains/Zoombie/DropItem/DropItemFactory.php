<?php

namespace App\Domains\Zoombie\DropItem;

use App\Domains\Item\Master\Item;
use App\Domains\Item\Master\ItemID;
use App\Domains\Item\Master\ItemRepository;
use App\Domains\Zombie\DropItem\DropRate;
use App\Domains\Zombie\ZombieID;

class DropItemFactory
{
    /**
     * @var ItemRepository
     */
    private $itemRepository;

    /**
     * @param ItemRepository $itemRepository
     */
    public function __construct(
        ItemRepository $itemRepository
    )
    {
        $this->itemRepository = $itemRepository;
    }

    /**
     * @param ZombieID $zombieID
     * @param Item $item
     * @param DropRate $dropRate
     * @return DropItem
     */
    public function make(
        ZombieID $zombieID,
        Item $item,
        DropRate $dropRate
    ): DropItem
    {
        return new DropItem($zombieID, $item, $dropRate);
    }

    /**
     * @param \App\DropItem $eloquent
     * @return DropItem
     */
    public function makeByEloquent(\App\DropItem $eloquent): DropItem
    {
        $item = $this->itemRepository->find(new ItemID($eloquent->item_id));
        return $this->make(
            new ZombieID($eloquent->zombie_id),
            $item,
            new DropRate($eloquent->drop_rate)
        );
    }


}