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
     * @var Count
     */
    private $count;

    /**
     * @param  User $user
     * @param Weapon $weapon
     * @param HavingWeaponId $havingWeaponId
     * @param Count $count
     */
    public function __construct(
        User $user,
        Weapon $weapon,
        HavingWeaponId $havingWeaponId,
        Count $count
    )
    {
        $this->weapon = $weapon;
        $this->user = $user;
        $this->havingWeaponId = $havingWeaponId;
        $this->count = $count;
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
     * @return Count
     */
    public function getCount(): Count
    {
        return $this->count;
    }

    /**
     * @return HavingWeapon
     * @throws \Exception
     */
    public function sub(int $value): HavingWeapon
    {
        $this->count = $this->count->subtract($value);
        return $this;
    }

    /**
     * @return HavingWeapon
     */
    public function add(int $value): HavingWeapon
    {
        $this->count = $this->count->add($value);
        return $this;
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }
}