<?php

namespace App\Domains\Character\Having;

use App\Domains\Character\Character;
use App\Domains\Character\CharacterID;
use App\Domains\Character\CharacterRepository;
use App\Domains\User\GameUserID;

class HavingCharacterFactory
{

    private $characterRepository;

    public function __construct(
        CharacterRepository $characterRepository
    )
    {
        $this->characterRepository = $characterRepository;
    }

    /**
     * @param  Character $character
     * @param  GameUserID $gameUserID
     * @return HavingCharacter
     */
    public function make(
        Character $character,
        GameUserID $gameUserID
    ) : HavingCharacter
    {
        return new HavingCharacter(
            $character,
            $gameUserID
        );
    }

    /**
     * @param \App\HavingCharacter $eloquent
     * @return  HavingCharacter
     */
    public function makeByEloquent(
        \App\HavingCharacter $eloquent
    ): HavingCharacter
    {
        $character = $this->characterRepository->find(new CharacterID($eloquent->character_id));
        return $this->make(
            $character,
            new GameUserID($eloquent->game_user_id)
        );
    }
}