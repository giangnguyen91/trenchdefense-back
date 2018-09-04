<?php

namespace App\Domains\Zombie;

class Zombie
{
    /**
     * @var Damage
     */
    private $damage;

    /**
     * @var Armor
     */
    private $armor;

    /**
     * @var Hp
     */
    private $hp;

    /**
     * @var Name
     */
    private $name;

    /**
     * @var ResourceID
     */
    private $resourceID;

    /**
     * @var Speed
     */
    private $speed;

    /**
     * @var ZombieID
     */
    private $zombieID;

    /***/
    public function __construct(
        Damage $damage,
        Armor $armor,
        Hp $hp,
        Name $name,
        ResourceID $resourceID,
        Speed $speed,
        ZombieID $zombieID
    )
    {
        $this->damage = $damage;
        $this->armor = $armor;
        $this->hp = $hp;
        $this->name = $name;
        $this->resourceID = $resourceID;
        $this->speed = $speed;
        $this->zombieID = $zombieID;
    }

    /**
     * @return Damage
     */
    public function getDamage(): Damage
    {
        return $this->damage;
    }

    /**
     * @return Armor
     */
    public function getArmor(): Armor
    {
        return $this->armor;
    }


    /**
     * @return Hp
     */
    public function getHp(): Hp
    {
        return $this->hp;
    }

    /**
     * @return Name
     */
    public function getName(): Name
    {
        return $this->name;
    }

    /**
     * @return ResourceID
     */
    public function getResourceID(): ResourceID
    {
        return $this->resourceID;
    }

    /**
     * @return Speed
     */
    public function getSpeed(): Speed
    {
        return $this->speed;
    }
}