<?php

namespace App\Domains\Item\Master;

use App\Domains\Base\ResourceID;

class ItemFactory
{
    /**
     * @param ItemID $itemID
     * @param Count $count
     * @param Type $type
     * @param ResourceID $resourceID
     * @param Name $name
     * @return Item
     */
    public function make(
        ItemID $itemID,
        Count $count,
        Type $type,
        ResourceID $resourceID,
        Name $name
    ): Item
    {
        return new Item($itemID, $count, $type, $resourceID, $name);
    }


    /**
     * @return Item
     */
    public function makeByEloquent(\App\Item $eloquent): Item
    {
        $itemID = new ItemID($eloquent->id);
        $count = new Count($eloquent->count);
        $type = new Type($eloquent->type);
        $resourceID = new ResourceID($eloquent->resource_id);
        $name = new Name($eloquent->name);
        return $this->make($itemID, $count, $type, $resourceID, $name);
    }

}