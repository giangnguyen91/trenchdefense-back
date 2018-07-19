<?php

namespace App\Domains\Weapon\Master;

class WeaponFactory
{

    /**
     * @param WeaponId $weaponId
     * @param Damage $damage
     * @param ReloadSpeed $reloadSpeed
     * @param ShotSpeed $shotSpeed
     * @param DelayTime $delayTime
     * @return Weapon
     */
    public function make(
        WeaponId $weaponId,
        Damage $damage,
        ReloadSpeed $reloadSpeed,
        ShotSpeed $shotSpeed,
        DelayTime $delayTime
    ): Weapon
    {
        return new Weapon(
            $weaponId,
            $damage,
            $reloadSpeed,
            $shotSpeed,
            $delayTime
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
            new ShotSpeed($weapon->shot_speed),
            new DelayTime($weapon->delay_time)
        );
    }
}