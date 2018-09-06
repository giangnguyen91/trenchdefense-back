<?php

namespace App\Domains\Character\Having;

use App\Domains\Character\Character;
use App\Domains\User\GameUserID;
use Illuminate\Support\Collection;

class HavingCharacter
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
     * @param  Character $character
     * @param  GameUserID $gameUserID
     */
    public function __construct(
        Character $character,
        GameUserID $gameUserID
    )
    {
        $this->character = $character;
        $this->gameUserID = $gameUserID;
    }

    /**
     * @return  GameUserID
     */
    public function getGameUserID(): GameUserID
    {
        return $this->gameUserID;
    }

    /**
     * @return Character
     */
    public function getCharacter(): Character
    {
        return $this->character;
    }


    /**
     * @return \App\Proto\HavingCharacter
     */
    public function toProtobuf(): \App\Proto\HavingCharacter
    {
        $proto = new \App\Proto\HavingCharacter();
        $proto->character = $this->getCharacter()->toProtobuf();
        return $proto;
    }

}