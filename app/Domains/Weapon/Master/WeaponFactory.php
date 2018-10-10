<?php

namespace App\Domains\Weapon\Master;

use App\Domains\Weapon\ThrowableWeapon;
use App\Weapon as WeaponEloquent;

class WeaponFactory
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
     * @param WeaponId $weaponId
     * @param WeaponName $weaponName
     * @param WeaponGroup $weaponGroup
     * @param Damage $damage
     * @param ResourceID $resourceID
     * @param MagCapacity $magCapacity
     * @param FireSpeed $fireSpeed
     * @param Range|null $range
     * @param ThrowableWeapon $throwableWeapon
     * @return Weapon
     */
    public function make(
        WeaponId $weaponId,
        WeaponName $weaponName,
        WeaponGroup $weaponGroup,
        Damage $damage,
        ResourceID $resourceID,
        MagCapacity $magCapacity,
        FireSpeed $fireSpeed,
        Range $range,
        ThrowableWeapon $throwableWeapon
    ): Weapon
    {
        return new Weapon(
            $weaponId,
            $weaponName,
            $weaponGroup,
            $damage,
            $resourceID,
            $magCapacity,
            $fireSpeed,
            $range,
            $throwableWeapon
        );
    }

    /**
     * @param array $array
     * @return Weapon
     */
    public function makeByArray(array $array): Weapon
    {
        $weaponID = !empty($array['id']) ? new WeaponId(intval($array['id'])) : new WeaponId(null);
        $weaponName = new WeaponName($array['name']);
        $weaponGroup = $this->weaponGroupRepository->find(new WeaponGroupID($array['weapon_group_id']));
        $weaponDamage = new Damage($array['damage']);
        $resourceID = new ResourceID($array['resource_id']);
        $magCapacity = new MagCapacity($array['mag_capacity']);
        $fireSpeed = new FireSpeed($array['fire_speed']);
        $range = new Range($array["range"]);
        $throwable = new ThrowableWeapon(boolval($array["throwable"]));
        return $this->make(
            $weaponID,
            $weaponName,
            $weaponGroup,
            $weaponDamage,
            $resourceID,
            $magCapacity,
            $fireSpeed,
            $range,
            $throwable
        );
    }

    /**
     * @param \App\Weapon $weapon
     * @return Weapon
     */
    public function makeByEloquent(
        WeaponEloquent $weapon
    ): Weapon
    {
        $weaponGroup = $this->weaponGroupRepository->find(new WeaponGroupID($weapon->weapon_group_id));
        return $this->make(
            new WeaponId($weapon->id),
            new WeaponName($weapon->name),
            $weaponGroup,
            new Damage($weapon->damage),
            new ResourceID($weapon->resource_id),
            new MagCapacity($weapon->mag_capacity),
            new FireSpeed($weapon->fire_speed),
            new Range($weapon->range),
            new ThrowableWeapon($weapon->range)
        );
    }
}