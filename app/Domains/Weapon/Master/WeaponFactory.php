<?php

namespace App\Domains\Weapon\Master;

class WeaponFactory
{

    /**
     * @param Damage $damage
     * @param ReloadSpeed $reloadSpeed
     * @param ShotSpeed $shotSpeed
     * @return Weapon
     */
    public function make(
        WeaponId $weaponId,
        Damage $damage,
        ReloadSpeed $reloadSpeed,
        ShotSpeed $shotSpeed
    ): Weapon
    {
        return new Weapon(
            $weaponId,
            $damage,
            $reloadSpeed,
            $shotSpeed
        );
    }

    /**
     * @param \App\Weapon $weapon
     * @return Weapon | null
     */
    public function makeByEloquent(
        \App\Weapon $weapon
    ): ?Weapon
    {

        return $this->make(
            new WeaponId($weapon->id),
            new Damage($weapon->damage),
            new ReloadSpeed($weapon->reload_speed),
            new ShotSpeed($weapon->shot_speed)
        );
    }
}