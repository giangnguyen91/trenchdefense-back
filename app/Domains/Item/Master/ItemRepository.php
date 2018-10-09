<?php

namespace App\Domains\Item\Master;

class ItemRepository
{
    /**
     * @var ItemFactory
     */
    private $itemFactory;

    /**
     * @param ItemFactory $itemFactory
     */
    public function __construct(
        ItemFactory $itemFactory
    )
    {
        $this->itemFactory = $itemFactory;
    }

    /**
     * @param ItemID $itemID
     * @return Item
     */
    public function find(ItemID $itemID): ?Item
    {
        $eloquent = \App\Item::query()->where('id', $itemID->getValue())->first();

        if (is_null($eloquent)) return null;

        return $this->itemFactory->makeByEloquent($eloquent);
    }

    /**
     * @param Item $item
     * @return ItemID
     */
    public function persist(Item $item): ItemID
    {
        $eloquent = \App\Item::unguarded(function () use ($item) {
            return \App\Item::query()->updateOrCreate(
                [
                    'id' => $item->getItemID()->getValue()
                ],
                [
                    'type' => $item->getType()->getValue(),
                    'count' => $item->getCount()->getValue()
                ]
            );
        });

        return new ItemID($eloquent->id);
    }
}