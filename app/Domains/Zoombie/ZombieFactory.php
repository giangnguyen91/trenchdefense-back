<?php
namespace App\Domains\Zombie;

class ZombieFactory
{
    /**
     * @param Damage $damage
     * @param Attack $attack
     * @param Hp $hp
     * @param Name $name
     * @param ResourceID $resourceID
     * @param Speed $speed
     * @param ZombieID $zombieID
     * @return Zombie
     */
    public function make(
        Damage $damage,
        Attack $attack,
        Hp $hp,
        Name $name,
        ResourceID $resourceID,
        Speed $speed,
        ZombieID $zombieID
    ): Zombie
    {
        return new Zombie(
            $damage,
            $attack,
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
        return $this->make(
            new Damage($eloquent->damage),
            new Attack($eloquent->attack),
            new Hp($eloquent->hp),
            new Name($eloquent->name),
            new ResourceID($eloquent->resource_id),
            new Speed($eloquent->speed),
            new ZombieID($eloquent->id)
        );
    }

    /**
     * @param array $array
     * @return Zombie
     */
    public function makeByArray(array $array)
    {
        $zombieID = !empty($array['id']) ? new ZombieID($array['id']) : new ZombieID(null);

        return $this->make(
            new Damage($array['damage']),
            new Attack($array['attack']),
            new Hp($array['hp']),
            new Name($array['name']),
            new ResourceID($array['resource_id']),
            new Speed($array['speed']),
            $zombieID
        );
    }
}