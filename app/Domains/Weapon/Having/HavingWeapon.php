<?php

namespace App\Domains\Weapon\Having;

use App\Domains\User\User;
use App\Domains\Weapon\Master\Weapon;

class HavingWeapon
{
    /**
     * @var User
     */
    private $user;

    /**
     * @var Weapon
     */
    private $weapon;

    /**
     * @var HavingWeaponId
     */
    private $havingWeaponId;

    /**
     * @param User $user
     * @param Weapon $weapon
     * @param HavingWeaponId $havingWeaponId
     */
    public function __construct(
        User $user,
        Weapon $weapon,
        HavingWeaponId $havingWeaponId
    )
    {
        $this->weapon = $weapon;
        $this->user = $user;
        $this->havingWeaponId = $havingWeaponId;
    }

    /**
     * @return  Weapon
     */
    public function getWeapon(): Weapon
    {
        return $this->weapon;
    }

    /**
     * @return  HavingWeaponId
     */
    public function getHavingId(): HavingWeaponId
    {
        return $this->havingWeaponId;
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }
}