<?php
namespace App\Domains\Zombie;

class ZombieFactory
{
    /**
     * @param Damage $damage
     * @param Armor $armor
     * @param Hp $hp
     * @param Name $name
     * @param ResourceID $resourceID
     * @param Speed $speed
     * @param ZombieID $zombieID
     * @return Zombie
     */
    public function make(
        Damage $damage,
        Armor $armor,
        Hp $hp,
        Name $name,
        ResourceID $resourceID,
        Speed $speed,
        ZombieID $zombieID
    ): Zombie
    {
        return new Zombie(
            $damage,
            $armor,
            $hp,
            $name,
            $resourceID,
            $speed,
            $zombieID
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
        return new Zombie(
            new Damage($eloquent->damage),
            new Armor($eloquent->armor),
            new Hp($eloquent->hp),
            new Name($eloquent->name),
            new ResourceID($eloquent->resource_id),
            new Speed($eloquent->speed),
            new ZombieID($eloquent->id)
        );
    }
}