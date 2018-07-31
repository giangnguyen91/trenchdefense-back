<?php

namespace App\Domains\Weapon\Having;

use App\Domains\User\UserId;
use Illuminate\Support\Collection;

class HavingWeaponRepository
{
    /**
     * @var HavingWeaponFactory
     */
    private $havingWeaponFactory;

    /**
     * @param HavingWeaponFactory $havingWeaponFactory
     */
    public function __construct(
        HavingWeaponFactory $havingWeaponFactory
    )
    {
        $this->havingWeaponFactory = $havingWeaponFactory;
    }

    /**
     * @param UserId $userId
     * @return Collection
     */
    public function findByUserId(
        UserId $userId
    ): Collection
    {
        $havingWeaponEloquents = \App\HavingWeapon::query()->where('user_id', $userId->getValue())->get();

        return collect($havingWeaponEloquents)->map(function (\App\HavingWeapon $eloquent) {
            return $this->havingWeaponFactory->makeByEloquent($eloquent);
        });
    }

    /**
     * @param HavingWeapon $havingWeapon
     */
    public function persist(
        HavingWeapon $havingWeapon
    )
    {
        \App\HavingWeapon::unguarded(function () use ($havingWeapon) {
            return \App\HavingWeapon::query()->updateOrCreate(
                [
                    'user_id' => $havingWeapon->getUser()->getUserId()->getValue(),
                    'weapon_id' => $havingWeapon->getWeapon()->getId()->getValue()
                ]
            );
        });
    }
}