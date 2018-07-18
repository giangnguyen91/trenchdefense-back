<?php

namespace App\Domains\Weapon\Master;

class UserRepository
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
        $weponEloquent = \App\Weapon::query()->find($weaponId->getValue())->first();
        if (is_null($weponEloquent)) return null;
        return $this->weaponFactory->makeByEloquent($weponEloquent);
    }

    /**
     * @param Weapon $weapon
     * @return WeaponId
     */
    public function persist(
        Weapon $weapon
    ): WeaponId
    {
        $eloquent = \App\User::unguarded(function () use ($weapon){
            return \App\User::query()->updateOrCreate(
                [
                    'id' => !is_null($weapon->getId()->getValue()) ? $weapon->getId()->getValue() : null
                ],
                [
                    'damage' => $weapon->getDamage()->getValue(),
                    'reload_speed' => $weapon->getReloadSpeed()->getValue(),
                    'shot_speed' => $weapon->getShotSpeed()->getValue()
                ]
            );
        });

        return new WeaponId($eloquent->id);
    }
}