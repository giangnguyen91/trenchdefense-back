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
        $weaponEloquent = \App\Weapon::query()->find($weaponId->getValue())->first();
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
                    'damage' => $weapon->getDamage()->getValue(),
                    'reload_speed' => $weapon->getReloadSpeed()->getValue(),
                    'shot_speed' => $weapon->getShotSpeed()->getValue(),
                    'delay_time' => $weapon->getDelayTime()->getValue()
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
}