<?php
/**
 * Created by PhpStorm.
 * User: luan.tran
 * Date: 9/7/18
 * Time: 13:48
 */

namespace App\Domains\Weapon\Master;

use App\WeaponGroup as WeaponGroupEloquent;
use Illuminate\Support\Collection;

class WeaponGroupRepository implements IWeaponGroupRepository
{
    /**
     * @var WeaponGroupFactory
     */
    private $weaponGroupFactory;

    public function __construct( WeaponGroupFactory $weaponGroupFactory )
    {
        $this->weaponGroupFactory = $weaponGroupFactory;
    }

    /**
     * Get all weapon groups
     * @return WeaponGroup[] | Collection
     */
    public function getAll(): Collection
    {
        $groupEloquents = WeaponGroupEloquent::all();
        return $groupEloquents->map(function(WeaponGroupEloquent $eloquent){
            return $this->weaponGroupFactory->makeByEloquent($eloquent);
        });
    }

    /**
     * Find weapon group by ID
     * @param WeaponGroupID $weaponGroupID
     * @return WeaponGroup|null
     */
    public function find(WeaponGroupID $weaponGroupID): ?WeaponGroup
    {
        $weaponGroupEloquent = WeaponGroupEloquent::find($weaponGroupID->getValue());
        if(is_null($weaponGroupEloquent)) return null;

        return $this->weaponGroupFactory->makeByEloquent($weaponGroupEloquent);
    }

    /**
     * Update or create a weapon group
     * @param WeaponGroup $weaponGroup
     * @return WeaponGroupID
     */
    public function persist(WeaponGroup $weaponGroup): WeaponGroupID
    {
        $eloquent = WeaponGroupEloquent::unguarded(function () use ($weaponGroup) {
            return WeaponGroupEloquent::query()->updateOrCreate(
                [
                    'id' => !is_null($weaponGroup->getID()->getValue()) ? $weaponGroup->getID()->getValue() : null
                ],
                [
                    'name' => $weaponGroup->getName()->getValue(),
                    'ammo_type' => $weaponGroup->getAmmoType()->getValue()
                ]
            );
        });

        return new WeaponGroupID($eloquent->id);
    }

    /**
     * @param WeaponGroup $weaponGroup
     * @return mixed
     */
    public function delete(WeaponGroup $weaponGroup)
    {
        return WeaponGroupEloquent::destroy($weaponGroup->getID()->getValue());
    }
}