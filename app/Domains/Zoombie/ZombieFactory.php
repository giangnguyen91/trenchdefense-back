<?php

namespace App\Domains\Zombie;

use App\Domains\Zoombie\DropItem\DropItemRepository;
use Illuminate\Support\Collection;

class ZombieFactory
{
    /**
     * @var DropItemRepository
     */
    private $dropItemRepository;

    /**
     * @param  DropItemRepository $dropItemRepository
     */
    public function __construct(
        DropItemRepository $dropItemRepository
    )
    {
        $this->dropItemRepository = $dropItemRepository;
    }

    /**
     * @param Damage $damage
     * @param Attack $attack
     * @param Hp $hp
     * @param Name $name
     * @param ResourceID $resourceID
     * @param Speed $speed
     * @param ZombieID $zombieID
     * @param Collection $dropItems
     * @return Zombie
     */
    public function make(
        Damage $damage,
        Attack $attack,
        Hp $hp,
        Name $name,
        ResourceID $resourceID,
        Speed $speed,
        ZombieID $zombieID,
        DropGold $dropGold,
        Collection $dropItems
    ): Zombie
    {
        return new Zombie(
            $damage,
            $attack,
            $hp,
            $name,
            $resourceID,
            $speed,
            $zombieID,
            $dropGold,
            $dropItems
        );
    }

    /**
     * @param \App\Zombie $eloquent
     * @return Zombie
     */
    public function makeByEloquent(
        \App\Zombie $eloquent
    ): Zombie
    {
        $dropItems = $this->dropItemRepository->findByZombieID(new ZombieID($eloquent->id));
        return $this->make(
            new Damage($eloquent->damage),
            new Attack($eloquent->attack),
            new Hp($eloquent->hp),
            new Name($eloquent->name),
            new ResourceID($eloquent->resource_id),
            new Speed($eloquent->speed),
            new ZombieID($eloquent->id),
            new DropGold($eloquent->drop_gold),
            $dropItems
        );
    }

    /**
     * @param array $array
     * @return Zombie
     */
    public function makeByArray(array $array)
    {
        $zombieID = !empty($array['id']) ? new ZombieID($array['id']) : new ZombieID(null);
        $dropItems = $this->dropItemRepository->findByZombieID($zombieID);
        return $this->make(
            new Damage($array['damage']),
            new Attack($array['attack']),
            new Hp($array['hp']),
            new Name($array['name']),
            new ResourceID($array['resource_id']),
            new Speed($array['speed']),
            $zombieID,
            new DropGold($array['drop_gold']),
            $dropItems
        );
    }
}