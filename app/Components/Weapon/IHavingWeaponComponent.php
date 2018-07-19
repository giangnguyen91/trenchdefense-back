<?php

namespace App\Components\Weapon;

use App\Domains\User\UserId;
use App\Domains\Weapon\Having\HavingWeapon;
use Illuminate\Support\Collection;

interface IHavingWeaponComponent
{
    /**
     * @param UserId $userId
     * @return HavingWeapon[] | Collection
     **/
    public function getByGameUserId(
        UserId $userId
    ): Collection;
}