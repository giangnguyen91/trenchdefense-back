<?php

namespace App\Domains\User\Setting;

use App\Domains\User\GameUserID;

class GameSettingRepository
{
    /**
     * @var GameSettingFactory
     */
    private $gameSettingFactory;

    /**
     * @param GameSettingFactory $gameSettingFactory
     */
    public function __construct(GameSettingFactory $gameSettingFactory)
    {
        $this->gameSettingFactory = $gameSettingFactory;
    }

    /**
     * @param GameUserID $gameUserID
     * @return GameSetting|null
     */
    public function findByID(GameUserID $gameUserID): ?GameSetting
    {
        $gameSettingEloquent = \App\GameSetting::query()->where('game_user_id', $gameUserID->getValue())->first();
        if (is_null($gameSettingEloquent)) return null;

        return $this->gameSettingFactory->makeByEloquent($gameSettingEloquent);
    }

    /**
     * @param GameSetting $gameSetting
     * @return mixed
     */
    public function persist(GameSetting $gameSetting)
    {
        \App\GameSetting::unguarded(function () use ($gameSetting) {
            return \App\GameSetting::query()->updateOrCreate(
                [
                    'game_user_id' => is_null($gameSetting->getGameUserID()->getValue()) ? null : $gameSetting->getGameUserID()->getValue()
                ],
                [
                    'volume' => $gameSetting->getVolume()->getValue(),
                    'sfx' => $gameSetting->getSfx()->getValue(),
                    'bgm' => $gameSetting->getBgm()->getValue()
                ]
            );
        });
    }
}