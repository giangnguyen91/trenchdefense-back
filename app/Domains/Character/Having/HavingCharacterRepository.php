<?php

namespace App\Domains\Character\Having;

use App\Domains\Character\CharacterID;
use App\Domains\User\GameUserID;
use Illuminate\Support\Collection;

class HavingCharacterRepository
{
    /**
     * @var HavingCharacterFactory
     */
    private $havingCharacterFactory;

    /**
     * @param HavingCharacterFactory $havingCharacterFactory
     */
    public function __construct(
        HavingCharacterFactory $havingCharacterFactory
    )
    {
        $this->havingCharacterFactory = $havingCharacterFactory;
    }

    /**
     * @param GameUserID $gameUserID
     * @return Collection |HavingCharacter[]
     */
    public function findByGameUserID(
        GameUserID $gameUserID
    ): Collection
    {
        $havingCharacterEloquent = \App\HavingCharacter::query()->where('game_user_id', $gameUserID->getValue())->get();

        if (is_null($havingCharacterEloquent)) return null;
        return collect($havingCharacterEloquent)->map(function (\App\HavingCharacter $eloquent) {
            return $this->havingCharacterFactory->makeByEloquent($eloquent);
        });
    }

    /**
     * @param GameUserID $gameUserID
     * @param CharacterID $characterID
     * @return mixed
     */
    public function persist(
        GameUserID $gameUserID,
        CharacterID $characterID
    )
    {
        \App\HavingCharacter::unguarded(function () use ($gameUserID, $characterID) {
            return \App\HavingCharacter::query()->create(
                [
                    'character_id' => $characterID->getValue(),
                    'game_user_id' => $gameUserID->getValue()
                ]
            );
        });
    }
}