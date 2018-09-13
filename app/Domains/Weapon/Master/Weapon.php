<?php

namespace App\Domains\Weapon\Master;


class Weapon
{
    /**
     * @var WeaponId
     */
    private $weaponId;

    /**
     * @var WeaponName
     */
    private $weaponName;

    /**
     * @var WeaponGroup
     */
    private $weaponGroup;

    /**
     * @var Damage
     */
    private $damage;

    /**
     * @var ResourceID
     */
    private $resourceID;

    /**
     * @param WeaponId $weaponId
     * @param WeaponName $weaponName
     * @param WeaponGroup $weaponGroup
     * @param Damage $damage
     * @param ResourceID $resourceID
     */
    public function __construct(
        WeaponId $weaponId,
        WeaponName $weaponName,
        WeaponGroup $weaponGroup,
        Damage $damage,
        ResourceID $resourceID
    )
    {
        $this->weaponId = $weaponId;
        $this->weaponGroup = $weaponGroup;
        $this->damage = $damage;
        $this->weaponName = $weaponName;
        $this->resourceID = $resourceID;
    }

    /**
     * @return WeaponId
     */
    public function getId(): WeaponId
    {
        return $this->weaponId;
    }

    /**
     * @return WeaponName
     */
    public function getWeaponName(): WeaponName
    {
        return $this->weaponName;
    }

    /**
     * @return WeaponGroup
     */
    public function getWeaponGroup(): WeaponGroup
    {
        return $this->weaponGroup;
    }

    /**
     * @return Damage
     */
    public function getDamage(): Damage
    {
        return $this->damage;
    }

    public function getResourceID(): ResourceID
    {
        return $this->resourceID;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return [
            'id' => $this->weaponId->getValue(),
            'name' => $this->weaponName->getValue(),
            'weapon_group_id' => $this->weaponGroup->getID()->getValue(),
            'damage' => $this->damage->getValue(),
            'resource_id' => $this->resourceID->getValue()
        ];
    }

    /**
     * @return \App\Proto\Weapon
     */
    public function toProtobuf(): \App\Proto\Weapon
    {
        $model = new \App\Proto\Weapon();
        $model->id = $this->weaponId->getValue();
        $model->name = $this->weaponName->getValue();
        $model->damage = $this->damage->getValue();
        $model->resourceId = $this->resourceID->getValue();
        $model->group = $this->weaponGroup->toProtobuf();
        return $model;
    }
}