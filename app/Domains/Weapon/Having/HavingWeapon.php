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
     * @var User $user
     * @var Weapon $weapon
     */
    public function __construct(
        User $user,
        Weapon $weapon
    )
    {
        $this->weapon = $weapon;
        $this->user = $user;
    }

    /**
     * @return  Weapon
     */
    public function getWeapon(): Weapon
    {
        return $this->weapon;
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }
}