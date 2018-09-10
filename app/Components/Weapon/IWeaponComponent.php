<?php

namespace App\Components\Weapon;

use App\Domains\Weapon\Master\Weapon;
use App\Domains\Weapon\Master\WeaponId;
use Illuminate\Support\Collection;

interface IWeaponComponent
{
    public function getAllWeapon(): Collection;
    public function addNew(Weapon $weapon): WeaponId;
    public function update(Weapon $weapon): WeaponId;
    public function delete(Weapon $weapon);
}