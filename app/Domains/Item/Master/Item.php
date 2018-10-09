<?php

namespace App\Domains\Item\Master;

use App\Domains\Base\ResourceID;

class Item
{
    /**
     * @var Count
     */
    private $count;

    /**
     * @var Type
     */
    private $type;

    /**
     * @var ItemID
     */
    private $itemID;

    /**
     * @var ResourceID
     */
    private $resourceID;

    /**
     * @var Name
     */
    private $name;

    /**
     * @param ItemID $itemID
     * @param Count $count
     * @param Type $type
     * @param ResourceID $resourceID
     * @param Name $name
     */
    public function __construct(
        ItemID $itemID,
        Count $count,
        Type $type,
        ResourceID $resourceID,
        Name $name
    )
    {
        $this->itemID = $itemID;
        $this->count = $count;
        $this->type = $type;
        $this->resourceID = $resourceID;
        $this->name = $name;
    }

    /**
     * @return Count
     */
    public function getCount(): Count
    {
        return $this->count;
    }

    /**
     * @return Type
     */
    public function getType(): Type
    {
        return $this->type;
    }

    /**
     * @return ItemID
     */
    public function getItemID(): ItemID
    {
        return $this->itemID;
    }

    /**
     * @return ResourceID
     */
    public function getResourceID(): ResourceID
    {
        return $this->resourceID;
    }

    /**
     * @return Name
     */
    public function getName(): Name
    {
        return $this->name;
    }

    /**
     * @return \App\Proto\Item
     */
    public function toProtobuf(): \App\Proto\Item
    {
        $model = new \App\Proto\Item();
        $model->id = $this->getItemID()->getValue();
        $model->name = $this->getName()->getValue();
        $model->type = $this->getType()->getValue();
        $model->count = $this->getCount()->getValue();
        $model->resourceID = $this->getResourceID()->getValue();
        return $model;
    }

}