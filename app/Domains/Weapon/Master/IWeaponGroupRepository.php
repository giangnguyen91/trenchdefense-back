<?php
/**
 * Created by PhpStorm.
 * User: luan.tran
 * Date: 9/7/18
 * Time: 13:49
 */

namespace App\Domains\Weapon\Master;

use Illuminate\Support\Collection;

interface IWeaponGroupRepository
{
    /**
     * @return WeaponGroup[]|Collection
     */
    public function getAll(): Collection;

    /**
     * Find weapon group by ID
     * @param WeaponGroupID $weaponGroupID
     * @return WeaponGroup
     */
    public function find(WeaponGroupID $weaponGroupID): ?WeaponGroup;

    /**
     * Update or create a weapon group
     * @param WeaponGroup $weaponGroup
     * @return WeaponGroupID
     */
    public function persist(WeaponGroup $weaponGroup): WeaponGroupID;

    /**
     * @param WeaponGroup $weaponGroup
     * @return mixed
     */
    public function delete(WeaponGroup $weaponGroup);
}