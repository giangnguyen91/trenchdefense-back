<?php

namespace App\Domains\Zoombie\DropItem;


use App\Domains\Zombie\ZombieID;
use Illuminate\Support\Collection;

class DropItemRepository
{
    /**
     * @var DropItemFactory
     */
    private $dropItemFactory;

    /**
     * @param DropItemFactory $dropItemFactory
     */
    public function __construct(
        DropItemFactory $dropItemFactory
    )
    {
        $this->dropItemFactory = $dropItemFactory;
    }

    /**
     * @param ZombieID $zombieID
     * @return Collection
     */
    public function findByZombieID(ZombieID $zombieID): Collection
    {
        $eloquent = \App\DropItem::query()->where('zombie_id', $zombieID->getValue())->get();

        return collect($eloquent)->map(function (\App\DropItem $eloquent) {
            return $this->dropItemFactory->makeByEloquent($eloquent);
        });
    }

    /**
     * @param DropItem $dropItem
     * @return void
     */
    public function persist(DropItem $dropItem)
    {
        \App\DropItem::unguarded(function () use ($dropItem) {
            return \App\DropItem::query()->create(
                [
                    'zombie_id' => $dropItem->getZombieID()->getValue(),
                    'item_id' => $dropItem->getItem()->getItemID()->getValue(),
                    'drop_rate' => $dropItem->getDropRate()->getValue()
                ]
            );
        });
    }


}