<?php

namespace App\Domains\Weapon\Master;

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
     * @return Weapon
     */
    public function make(
        WeaponId $weaponId,
        WeaponName $weaponName,
        WeaponGroup $weaponGroup,
        Damage $damage,
        ResourceID $resourceID
    ): Weapon
    {
        return new Weapon(
            $weaponId,
            $weaponName,
            $weaponGroup,
            $damage,
            $resourceID
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
        return $this->make(
            $weaponID,
            $weaponName,
            $weaponGroup,
            $weaponDamage,
            $resourceID
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
            new ResourceID($weapon->resource_id)
        );
    }
}