<?php

namespace App\Components\Weapon;

use App\Domains\User\UserId;
use App\Domains\Weapon\Having\HavingWeapon;
use App\Domains\Weapon\Having\HavingWeaponRepository;
use Illuminate\Support\Collection;

class HavingWeaponComponent implements IHavingWeaponComponent
{
    /**
     * @var HavingWeaponRepository
     */
    private $havingWeaponRepository;

    /**
     * @param HavingWeaponRepository $havingWeaponRepository
     */
    public function __construct(
        HavingWeaponRepository $havingWeaponRepository
    )
    {
        $this->havingWeaponRepository = $havingWeaponRepository;
    }

    /**
     * @param UserId $userId
     * @return HavingWeapon[] | Collection
     */
    public function getByGameUserId(
        UserId $userId
    ): Collection
    {
        return $this->havingWeaponRepository->findByUserId($userId);
    }
}