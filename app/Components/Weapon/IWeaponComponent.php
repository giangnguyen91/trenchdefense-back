<?php

namespace App\Components\Weapon;

use Illuminate\Support\Collection;

interface IWeaponComponent
{
    public function getAllWeapon(): Collection;
}