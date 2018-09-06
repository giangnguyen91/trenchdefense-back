<?php

namespace App\Domains\Character;

use App\Domains\Base\ResourceID;

class Character
{
    /**
     * @var Attack
     */
    private $attack;

    /**
     * @var Speed
     */
    private $speed;

    /**
     * @var Hp
     */
    private $hp;

    /**
     * @var CharacterID
     */
    private $characterID;

    /**
     * @var Name
     */
    private $name;

    /**
     * @var ResourceID
     */
    private $resourceID;

    /**
     * @param  CharacterID $characterID
     * @param  Attack $attack
     * @param  Speed $speed
     * @param  Hp $hp
     * @param  Name $name
     * @param  ResourceID $resourceID
     */
    public function __construct(
        CharacterID $characterID,
        Attack $attack,
        Speed $speed,
        Hp $hp,
        Name $name,
        ResourceID $resourceID
    )
    {
        $this->characterID = $characterID;
        $this->attack = $attack;
        $this->speed = $speed;
        $this->hp = $hp;
        $this->name = $name;
        $this->resourceID = $resourceID;
    }

    /**
     * @return  CharacterID
     */
    public function getId(): CharacterID
    {
        return $this->characterID;
    }

    /**
     * @return Hp
     */
    public function getHp(): Hp
    {
        return $this->hp;
    }

    /**
     * @return Attack
     */
    public function getAttack(): Attack
    {
        return $this->attack;
    }

    /**
     * @return Speed
     */
    public function getSpeed(): Speed
    {
        return $this->speed;
    }

    /**
     * @return ResourceID
     */
    public function getResourceID(): ResourceID
    {
        return $this->resourceID;
    }

    /**
     * @return Name
     */
    public function getName(): Name
    {
        return $this->name;
    }

    /**
     * @return \App\Proto\Character
     */
    public function toProtobuf(): \App\Proto\Character
    {
        $proto = new \App\Proto\Character();
        $proto->name = $this->name->getValue();
        $proto->hp = $this->hp->getValue();
        $proto->attack = $this->attack->getValue();
        $proto->speed = $this->speed->getValue();
        $proto->resourceID = $this->resourceID->getValue();
        return $proto;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return array(
            'name' => $this->name->getValue(),
            'hp' => $this->hp->getValue(),
            'attack' => $this->attack->getValue(),
            'speed' => $this->speed->getValue(),
            'resource_id' =>$this->resourceID->getValue()
        );
    }
}