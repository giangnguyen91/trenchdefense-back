<?php

namespace App\Components\Weapon;

use App\Domains\Weapon\Master\WeaponGroup;
use App\Domains\Weapon\Master\WeaponGroupID;
use Illuminate\Support\Collection;

interface IWeaponGroupComponent
{
    public function getAll(): Collection;

    public function addNew(WeaponGroup $weaponGroup): WeaponGroupID;

    public function findByID(WeaponGroupID $weaponGroupID): ?WeaponGroup;

    public function delete(WeaponGroup $weaponGroup);
}