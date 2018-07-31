<?php

namespace App\Domains\Zombie\Master;

/**
 * Class ZombieFactory
 * @package App\Domains\Zombie\Master
 */
class ZombieFactory
{
    /**
     * @param ZombieID $zombieID
     * @param Name $name
     * @param Damage $damage
     * @param HP $hp
     * @param Speed $speed
     * @param Armor $armor
     * @return Zombie
     */
    public function make(ZombieID $zombieID, Name $name, Damage $damage, HP $hp, Speed $speed, Armor $armor): Zombie
    {
        return new Zombie($zombieID, $name, $damage, $hp, $speed, $armor);
    }

    /**
     * @param \App\Eloquents\Zombie $zombie
     * @return Zombie
     */
    public function makeByEloquent(\App\Eloquents\Zombie $zombie): Zombie
    {
        return $this->make(
            new ZombieID($zombie->id),
            new Name($zombie->name),
            new Damage($zombie->damage),
            new HP($zombie->hp),
            new Speed($zombie->speed),
            new Armor($zombie->armor)
        );
    }
}
