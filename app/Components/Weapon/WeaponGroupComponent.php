<?php
/**
 * Created by PhpStorm.
 * User: luan.tran
 * Date: 9/7/18
 * Time: 15:25
 */

namespace App\Components\Weapon;


use App\Domains\Weapon\Master\IWeaponGroupRepository;
use App\Domains\Weapon\Master\WeaponGroup;
use App\Domains\Weapon\Master\WeaponGroupID;
use Illuminate\Support\Collection;

class WeaponGroupComponent implements IWeaponGroupComponent
{
    /**
     * @var IWeaponGroupRepository
     */
    private $weaponGroupRepository;

    public function __construct(IWeaponGroupRepository $weaponGroupRepository)
    {
        $this->weaponGroupRepository = $weaponGroupRepository;
    }

    /**
     * Get all weapon groups
     * @return WeaponGroup[]|Collection
     */
    public function getAll(): Collection
    {
        return $this->weaponGroupRepository->getAll();
    }

    /**
     * @param WeaponGroup $weaponGroup
     * @return WeaponGroupID
     */
    public function addNew(WeaponGroup $weaponGroup): WeaponGroupID
    {
        return $this->weaponGroupRepository->persist($weaponGroup);
    }

    /**
     * @param WeaponGroup $weaponGroup
     * @return WeaponGroupID
     */
    public function update(WeaponGroup $weaponGroup): WeaponGroupID
    {
        return $this->weaponGroupRepository->persist($weaponGroup);
    }

    /**
     * @param WeaponGroupID $weaponGroupID
     * @return WeaponGroup|null
     */
    public function findByID(WeaponGroupID $weaponGroupID): ?WeaponGroup
    {
        return $this->weaponGroupRepository->find($weaponGroupID);
    }

    /**
     * @param WeaponGroup $weaponGroup
     * @return mixed
     */
    public function delete(WeaponGroup $weaponGroup)
    {
        return $this->weaponGroupRepository->delete($weaponGroup);
    }
}