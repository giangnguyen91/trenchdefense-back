<?php

namespace App\Domains\Character\Having\Status;

use App\Domains\User\GameUserID;

class CharacterStatusRepository
{
    /**
     * @var CharacterStatusFactory
     */
    private $characterStatusFactory;

    /**
     * @var \Illuminate\Redis\Connections\Connection
     */
    private $redis;

    /**
     * @param CharacterStatusFactory $characterStatusFactory
     */
    public function __construct(
        CharacterStatusFactory $characterStatusFactory
    )
    {
        $this->characterStatusFactory = $characterStatusFactory;
    }

    /**
     * @param GameUserID $gameUserID
     * @return CharacterStatus
     */
    public function findByGameUserID(
        GameUserID $gameUserID
    ): ?CharacterStatus
    {
        $characterStatusEloquent = \App\CharacterStatus::query()->where('game_user_id', $gameUserID->getValue())->first();

        if (is_null($characterStatusEloquent)) return null;
        return $this->characterStatusFactory->makeByEloquent($characterStatusEloquent);
    }

    /**
     * @param CharacterStatus $characterStatus
     * @return void
     */
    public function persist(
        CharacterStatus $characterStatus
    )
    {
        \App\CharacterStatus::unguarded(function () use ($characterStatus) {
            return \App\CharacterStatus::query()->updateOrCreate(
                [
                    'game_user_id' => $characterStatus->getGameUserID()->getValue()
                ],
                [
                    'hp' => $characterStatus->getHp()->getValue(),
                    'wave_id' => $characterStatus->getWave()->getID()->getValue(),
                    'weapons' => json_encode($characterStatus->getWeaponsArray()),
                    'drop_gold' => $characterStatus->getDropGold()->getValue(),
                    'character_id' => $characterStatus->getCharacter()->getId()->getValue()
                ]
            );
        });
    }

    /**
     * @param GameUserID $gameUserID
     */
    public function removeByGameUserID(
        GameUserID $gameUserID
    )
    {
        \App\CharacterStatus::query()->where('game_user_id', $gameUserID->getValue())->delete();
    }
}