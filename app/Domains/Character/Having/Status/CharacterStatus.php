<?php

namespace App\Domains\Character\Having\Status;

use App\Domains\Character\Character;
use App\Domains\Character\Hp;
use App\Domains\User\GameUserID;
use App\Domains\Wave\Wave;
use App\Domains\Weapon\Master\Weapon;
use Illuminate\Support\Collection;

class CharacterStatus
{
    /**
     * @var  Character
     */
    private $character;

    /**
     * @var GameUserID
     */
    private $gameUserID;


    /**
     * @var Collection | Weapon[]
     */
    private $weapons;

    /**
     * @var DropGold
     */
    private $dropGold;

    /**
     * @var Wave
     */
    private $wave;

    /**
     * @var Hp
     */
    private $hp;

    /**
     * @param Character $character
     * @param GameUserID $gameUserID
     * @param Collection $weapons
     * @param Wave $wave
     * @param DropGold $dropGold
     * @param Hp $hp
     */
    public function __construct(
        Character $character,
        GameUserID $gameUserID,
        Collection $weapons,
        Wave $wave,
        DropGold $dropGold,
        Hp $hp
    )
    {
        $this->character = $character;
        $this->gameUserID = $gameUserID;
        $this->weapons = $weapons;
        $this->wave = $wave;
        $this->dropGold = $dropGold;
        $this->hp = $hp;
    }

    /**
     * @return Character
     */
    public function getCharacter() : Character
    {
        return $this->character;
    }

    /**
     * @return GameUserID
     */
    public function getGameUserID() : GameUserID
    {
        return $this->gameUserID;
    }

    /**
     * @return Collection | Weapon[]
     */
    public function getWeapons() : Collection
    {
        return $this->weapons;
    }

    /**
     * @return Wave
     */
    public function getWave() : Wave
    {
        return $this->wave;
    }

    /**
     * @return DropGold
     */
    public function getDropGold() : DropGold
    {
        return $this->dropGold;
    }

    /**
     * @return array
     */
    public function getWeaponsArray() : array
    {
        return $this->weapons->map(function(Weapon $weapon){
            return $weapon->getId()->getValue();
        })->toArray();
    }

    /**
     * @param DropGold $dropGold
     * @return CharacterStatus
     */
    public function addGold(DropGold $dropGold) : CharacterStatus
    {
        $this->dropGold =  new DropGold(
            $this->dropGold->renew(
                max($this->dropGold->getValue() + $dropGold->getValue(), 0)
            )->getValue()
        );
        return $this;
    }

    /**
     * @return Hp
     */
    public function getHp() : Hp
    {
        return $this->hp;
    }

    /**
     * @param Hp $hp
     * @return CharacterStatus
     */
    public function setHp(Hp $hp) : CharacterStatus
    {
        $this->hp = $hp;
        return $this;
    }

    /**
     * @param Collection $weapons
     * @return CharacterStatus
     */
    public function setWeapons(Collection $weapons): CharacterStatus
    {
        $this->weapons = $weapons;
        return $this;
    }

    /**
     * @return CharacterStatus
     */
    public function setWave(Wave $wave) : CharacterStatus
    {
        $this->wave = $wave;
        return $this;
    }

    /**
     * @return \App\Proto\CharacterStatus
     */
    public function toProtobuf() : \App\Proto\CharacterStatus
    {
        $model = new \App\Proto\CharacterStatus();
        $model->currentHp = $this->getHp()->getValue();
        $model->dropGold = $this->getDropGold()->getValue();
        $model->weapons = $this->getWeapons()->map(function(Weapon $weapon){
            return $weapon->toProtobuf();
        })->toArray();
        $model->character = $this->character->toProtobuf();
        return $model;
    }

}