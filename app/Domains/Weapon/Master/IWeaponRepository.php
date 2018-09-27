<?php

namespace App\Domains\Weapon\Master;

use Illuminate\Support\Collection;

interface IWeaponRepository
{
    /**
     * @param WeaponId $weaponId
     * @return Weapon | null
     */
    public function find(
        WeaponId $weaponId
    ): ?Weapon;

    /**
     * @param Weapon $weapon
     * @return WeaponId
     */
    public function persist(
        Weapon $weapon
    ): WeaponId;

    /**
     * @return Weapon[] | Collection
     */
    public function all(): Collection;

    /**
     * @param Collection $weaponIds
     * @return Collection
     */
    public function findByWeaponIDs(
        Collection $weaponIds
    ): Collection;
}