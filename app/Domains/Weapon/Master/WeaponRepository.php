<?php

namespace App\Domains\Weapon\Master;

use Illuminate\Support\Collection;

class WeaponRepository implements IWeaponRepository
{
    /**
     * @var WeaponFactory
     */
    private $weaponFactory;

    /**
     * @param WeaponFactory $weaponFactory
     */
    public function __construct(
        WeaponFactory $weaponFactory
    )
    {
        $this->weaponFactory = $weaponFactory;
    }

    /**
     * @param WeaponId $weaponId
     * @return Weapon | null
     */
    public function find(
        WeaponId $weaponId
    ): ?Weapon
    {
        $weaponEloquent = \App\Weapon::query()->find($weaponId->getValue());
        if (is_null($weaponEloquent)) return null;
        return $this->weaponFactory->makeByEloquent($weaponEloquent);
    }

    /**
     * @param Weapon $weapon
     * @return WeaponId
     */
    public function persist(
        Weapon $weapon
    ): WeaponId
    {
        $eloquent = \App\Weapon::unguarded(function () use ($weapon){
            return \App\Weapon::query()->updateOrCreate(
                [
                    'id' => !is_null($weapon->getId()->getValue()) ? $weapon->getId()->getValue() : null
                ],
                [
                    'name' => $weapon->getWeaponName()->getValue(),
                    'damage' => $weapon->getDamage()->getValue(),
                    'weapon_group_id' => $weapon->getWeaponGroup()->getID()->getValue(),
                    'resource_id' => $weapon->getResourceID()->getValue()
                ]
            );
        });

        return new WeaponId($eloquent->id);
    }

    /**
     * @return Weapon[] | Collection
     */
    public function all(): Collection
    {
        $weaponEloquent = \App\Weapon::query()->get();
        return collect($weaponEloquent)->map(function (\App\Weapon $eloquent){
            return $this->weaponFactory->makeByEloquent($eloquent);
        });
    }

    /**
     * @param Weapon $weapon
     * @return mixed
     */
    public function delete(Weapon $weapon)
    {
        return \App\Weapon::destroy($weapon->getID()->getValue());
    }
}