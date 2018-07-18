<?php

namespace App\Domains\Weapon\Having;

use App\Domains\User\User;
use App\Domains\User\UserId;
use App\Domains\User\UserRepository;
use App\Domains\Weapon\Master\Weapon;
use App\Domains\Weapon\Master\WeaponId;
use App\Domains\Weapon\Master\WeaponRepository;

class HavingWeaponFactory
{
    /**
    * @var UserRepository;
     */
    private $userRepository;

    /**
     * @var WeaponRepository;
     */
    private $weaponRepository;

    /**
     * @param  UserRepository $userRepository
     * @param WeaponRepository $weaponRepository
     */
    public function __construct(
        UserRepository $userRepository,
        WeaponRepository $weaponRepository
    )
    {
        $this->userRepository = $userRepository;
        $this->weaponRepository = $weaponRepository;
    }


    /**
     * @param User $user
     * @param Weapon $weapon
     * @return HavingWeapon
     */
    public function make(
        User $user,
        Weapon $weapon
    ) : HavingWeapon
    {
        return new HavingWeapon(
            $user,
            $weapon
        );
    }

    /**
     * @param \App\HavingWeapon $eloquent
     * @return HavingWeapon
     */
    public function makeByEloquent(\App\HavingWeapon $eloquent): HavingWeapon
    {
        $weapon = $this->weaponRepository->find(new WeaponId($eloquent->weapon_id));
        $user = $this->userRepository->find(new UserId($eloquent->user_id));

        return $this->make(
            $user,
            $weapon
        );
    }

}