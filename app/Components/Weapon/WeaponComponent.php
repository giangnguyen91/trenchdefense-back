<?php

namespace App\Components\Weapon;

use App\Domains\Weapon\Master\IWeaponRepository;
use App\Domains\Weapon\Master\Weapon;
use Illuminate\Support\Collection;

class WeaponComponent implements IWeaponComponent
{
    /**
     * @var IWeaponRepository
     */
    private $weaponRepository;

    /**
     * @param IWeaponRepository $weaponRepository
     */
    public function __construct(
        IWeaponRepository $weaponRepository
    )
    {
        $this->weaponRepository = $weaponRepository;
    }

    /**
     * @return Weapon[] | Collection
     */
    public function getAllWeapon(): Collection
    {
        return $this->weaponRepository->all();
    }
}