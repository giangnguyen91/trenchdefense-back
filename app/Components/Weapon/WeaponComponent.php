<?php

namespace App\Components\Weapon;

use App\Domains\Weapon\Master\IWeaponRepository;
use App\Domains\Weapon\Master\Weapon;
use App\Domains\Weapon\Master\WeaponId;
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

    /**
     * @param WeaponId $weaponId
     * @return Weapon|null
     */
    public function findByID(WeaponId $weaponId): ?Weapon
    {
        return $this->weaponRepository->find($weaponId);
    }

    /**
     * @param Weapon $weapon
     * @return WeaponId
     */
    public function addNew(Weapon $weapon): WeaponId
    {
        return $this->weaponRepository->persist($weapon);
    }

    public function update(Weapon $weapon): WeaponId
    {
        return $this->weaponRepository->persist($weapon);
    }

    public function delete(Weapon $weapon)
    {
        return $this->weaponRepository->delete($weapon);
    }
}