<?php

namespace App\Domains\Weapon\Master;

use App\WeaponGroup as WeaponGroupEloquent;

class WeaponGroupFactory
{
    public function make(
        WeaponGroupID $weaponGroupID,
        WeaponGroupName $weaponGroupName,
        AmmoType $ammoType
    ): WeaponGroup
    {
        return new WeaponGroup(
            $weaponGroupID,
            $weaponGroupName,
            $ammoType
        );
    }

    /**
     * @param array $array
     * @return WeaponGroup
     */
    public function makeByArray(array $array): WeaponGroup
    {
        $weaponGroupID = !empty($array['id']) ? new WeaponGroupID($array['id']) : new WeaponGroupID(null);
        return $this->make(
            $weaponGroupID,
            new WeaponGroupName($array['name']),
            new AmmoType($array['ammo_type'])
        );
    }

    /**
     * @param WeaponGroupEloquent $eloquent
     * @return WeaponGroup
     */
    public function makeByEloquent(WeaponGroupEloquent $eloquent): WeaponGroup
    {
        $weaponGroupID = new WeaponGroupID($eloquent->id);
        $weaponGroupName = new WeaponGroupName($eloquent->name);
        $ammoType = new AmmoType($eloquent->ammo_type);
        return $this->make(
            $weaponGroupID,
            $weaponGroupName,
            $ammoType
        );
    }

    /**
     * @param WeaponGroupname $groupName
     * @param AmmoType $ammoType
     * @return WeaponGroup
     */
    public function initialize(WeaponGroupname $groupName, AmmoType $ammoType): WeaponGroup
    {
        $weaponGroupID = new WeaponGroupID();
        return $this->make(
            $weaponGroupID,
            $groupName,
            $ammoType
        );
    }
}