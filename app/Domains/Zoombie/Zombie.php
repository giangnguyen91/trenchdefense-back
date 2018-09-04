<?php

namespace App\Domains\Zombie;

class Zombie
{
    /**
     * @var Damage
     */
    private $damage;

    /**
     * @var Attack
     */
    private $attack;

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

    /**
     * @var DropGold
     */
    private $dropGold;

    /***/
    public function __construct(
        Damage $damage,
        Attack $attack,
        Hp $hp,
        Name $name,
        ResourceID $resourceID,
        Speed $speed,
        ZombieID $zombieID,
        DropGold $dropGold
    )
    {
        $this->damage = $damage;
        $this->attack = $attack;
        $this->hp = $hp;
        $this->name = $name;
        $this->resourceID = $resourceID;
        $this->speed = $speed;
        $this->zombieID = $zombieID;
        $this->dropGold = $dropGold;
    }

    /**
     * @return Damage
     */
    public function getDamage(): Damage
    {
        return $this->damage;
    }

    /**
     * @return Attack
     */
    public function getAttack(): Attack
    {
        return $this->attack;
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

    /**
     * @return ZombieID
     */
    public function getID(): ZombieID
    {
        return $this->zombieID;
    }

    /**
     * @return DropGold
     */
    public function getDropGold(): DropGold
    {
        return $this->dropGold;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return array(
            'damage' => $this->getDamage()->getValue(),
            'attack' => $this->getAttack()->getValue(),
            'hp' => $this->getHp()->getValue(),
            'name' => $this->getName()->getValue(),
            'speed' => $this->getSpeed()->getValue(),
            'resource_id' => $this->getResourceID()->getValue(),
            'drop_gold' => $this->getDropGold()->getValue(),
        );
    }
}