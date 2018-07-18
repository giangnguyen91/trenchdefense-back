<?php

namespace App\Domains\Weapon\Master;

class Weapon
{
    /**
     * @var Damage
     */
    private $damage;

    /**
     * @var ReloadSpeed
     */
    private $reloadSpeed;

    /**
     * @var ShotSpeed
     */
    private $shotSpeed;

    /**
     * @var WeaponId
     */
    private $weaponId;

    /**
     * @param WeaponId $weaponId
     * @param Damage $damage
     * @param ReloadSpeed $reloadSpeed
     * @param ShotSpeed $shotSpeed
     */
    public function __construct(
        WeaponId $weaponId,
        Damage $damage,
        ReloadSpeed $reloadSpeed,
        ShotSpeed $shotSpeed
    )
    {
        $this->weaponId = $weaponId;
        $this->damage = $damage;
        $this->reloadSpeed = $reloadSpeed;
        $this->shotSpeed = $shotSpeed;
    }

    /**
     * @return Damage
     */
    public function getDamage(): Damage
    {
        return $this->damage;
    }

    /**
     * @return ReloadSpeed
     */
    public function getReloadSpeed(): ReloadSpeed
    {
        return $this->reloadSpeed;
    }

    /**
     * @return ShotSpeed
     */
    public function getShotSpeed(): ShotSpeed
    {
        return $this->shotSpeed;
    }

    /**
     * @return WeaponId
     */
    public function getId(): WeaponId
    {
        return $this->weaponId;
    }

    /**
     * @return \App\Proto\Weapon
     */
    public function toProtobuf(): \App\Proto\Weapon
    {
        $model = new \App\Proto\Weapon();
        $model->id = $this->getId()->getValue();
        $model->damage = $this->getDamage()->getValue();
        $model->reloadSpeed = $this->getReloadSpeed()->getValue();
        $model->shotSpeed = $this->getShotSpeed()->getValue();
        return $model;
    }
}