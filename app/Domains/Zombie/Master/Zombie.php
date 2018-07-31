<?php

namespace App\Domains\Zombie\Master;

/**
 * Class Zombie
 * @package App\Domains\Zombie\Master
 */
class Zombie
{
    /**
     * @var ZombieID
     */
    private $zombieID;

    /**
     * @var Name
     */
    private $name;

    /**
     * @var Damage
     */
    private $damage;

    /**
     * @var HP
     */
    private $hp;

    /**
     * @var Speed
     */
    private $speed;

    /**
     * @var Armor
     */
    private $armor;

    /**
     * Zombie constructor.
     * @param ZombieID $zombieID
     * @param Name $name
     * @param Damage $damage
     * @param HP $hp
     * @param Speed $speed
     * @param Armor $armor
     */
    public function __construct(ZombieID $zombieID, Name $name, Damage $damage, HP $hp, Speed $speed, Armor $armor)
    {
        $this->zombieID = $zombieID;
        $this->name = $name;
        $this->damage = $damage;
        $this->hp = $hp;
        $this->speed = $speed;
        $this->armor = $armor;
    }

    /**
     * @return ZombieID
     */
    public function getZombieID(): ZombieID
    {
        return $this->zombieID;
    }

    /**
     * @return Name
     */
    public function getName(): Name
    {
        return $this->name;
    }

    /**
     * @return Damage
     */
    public function getDamage(): Damage
    {
        return $this->damage;
    }

    /**
     * @return HP
     */
    public function getHp(): HP
    {
        return $this->hp;
    }

    /**
     * @return Speed
     */
    public function getSpeed(): Speed
    {
        return $this->speed;
    }

    /**
     * @return Armor
     */
    public function getArmor(): Armor
    {
        return $this->armor;
    }

    /**
     * @return \App\Proto\Zombie
     */
    public function toProtobuf(): \App\Proto\Zombie
    {
        $model = new \App\Proto\Zombie();
        $model->id = $this->getZombieID()->getValue();
        $model->name = $this->getName()->getValue();
        $model->damage = $this->getDamage()->getValue();
        $model->hp = $this->getHp()->getValue();
        $model->speed = $this->getSpeed()->getValue();
        $model->armor = $this->getArmor()->getValue();

        return $model;
    }
}
