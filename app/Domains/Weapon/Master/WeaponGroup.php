<?php
/**
 * Created by PhpStorm.
 * User: luan.tran
 * Date: 9/7/18
 * Time: 11:53
 */

namespace App\Domains\Weapon\Master;


class WeaponGroup
{
    private $weaponGroupID;

    private $weaponGroupName;

    private $ammoType;

    public function __construct(
        WeaponGroupID $weaponGroupID,
        WeaponGroupName $weaponGroupName,
        AmmoType $ammoType
    )
    {
        $this->weaponGroupID = $weaponGroupID;
        $this->weaponGroupName = $weaponGroupName;
        $this->ammoType = $ammoType;
    }

    /**
     * @return WeaponGroupID
     */
    public function getID(): WeaponGroupID
    {
        return $this->weaponGroupID;
    }

    /**
     * @return WeaponGroupName
     */
    public function getName(): WeaponGroupName
    {
        return $this->weaponGroupName;
    }

    /**
     * @return AmmoType
     */
    public function getAmmoType(): AmmoType
    {
        return $this->ammoType;
    }

    /**
     * Convert domain to array
     * @return array
     */
    public function toArray(): array
    {
        return array(
            'id' => $this->weaponGroupID->getValue(),
            'name' => $this->weaponGroupName->getValue(),
            'ammo_type' => $this->ammoType->getValue()
        );
    }

    /**
     * @return \App\Proto\WeaponGroup
     */
    public function toProtobuf(): \App\Proto\WeaponGroup
    {
        $model = new \App\Proto\WeaponGroup();
        $model->id = $this->weaponGroupID->getValue();
        $model->name = $this->weaponGroupName->getValue();
        $model->ammoType = $this->ammoType->getValue();
        return $model;
    }
}