<?php

namespace App\Domains\Weapon\Master;


use App\Domains\Weapon\ThrowableWeapon;

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
     * Mag capacity
     * @var MagCapacity
     */
    private $magCapacity;

    /**
     * Fire speed
     * @var FireSpeed
     */
    private $fireSpeed;

    /**
     * Explosion range
     * @var Range
     */
    private $range;

    /**
     * @var ThrowableWeapon
     */
    private $throwable;

    /**
     * @param WeaponId $weaponId
     * @param WeaponName $weaponName
     * @param WeaponGroup $weaponGroup
     * @param Damage $damage
     * @param ResourceID $resourceID
     * @param MagCapacity $magCapacity
     * @param FireSpeed $fireSpeed
     * @param Range $range
     * @param ThrowableWeapon $throwableWeapon
     */
    public function __construct(
        WeaponId $weaponId,
        WeaponName $weaponName,
        WeaponGroup $weaponGroup,
        Damage $damage,
        ResourceID $resourceID,
        MagCapacity $magCapacity,
        FireSpeed $fireSpeed,
        Range $range,
        ThrowableWeapon $throwableWeapon
    )
    {
        $this->weaponId = $weaponId;
        $this->weaponGroup = $weaponGroup;
        $this->damage = $damage;
        $this->weaponName = $weaponName;
        $this->resourceID = $resourceID;
        $this->magCapacity = $magCapacity;
        $this->fireSpeed = $fireSpeed;
        $this->range = $range;
        $this->throwable = $throwableWeapon;
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
     * @return MagCapacity
     */
    public function getMagCapacity(): MagCapacity
    {
        return $this->magCapacity;
    }

    /**
     * @return FireSpeed
     */
    public function getFireSpeed(): FireSpeed
    {
        return $this->fireSpeed;
    }

    /**
     * @return Range
     */
    public function getRange(): Range
    {
        return $this->range;
    }

    /**
     * @return bool
     */
    public function isThrowable(): bool
    {
        return $this->throwable->getValue();
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
            'resource_id' => $this->resourceID->getValue(),
            'mag_capacity' => $this->magCapacity->getValue(),
            'fire_speed' => $this->fireSpeed->getValue(),
            'range' => $this->range->getValue(),
            'throwable' => $this->isThrowable()
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
        $model->magCapacity = $this->magCapacity->getValue();
        $model->fireSpeed = $this->fireSpeed->getValue();
        $model->range = $this->range->getValue();
        $model->throwable = $this->isThrowable();
        return $model;
    }
}