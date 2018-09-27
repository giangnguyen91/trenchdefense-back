<?php

namespace App\Domains\User\Setting;

use App\Domains\User\GameUserID;

class GameSettingFactory
{
    /**
     * @param GameUserID $gameUserID
     * @param Bgm $bgm
     * @param Sfx $sfx
     * @param Volume $volume
     * @return GameSetting
     */
    public function make(
        GameUserID $gameUserID,
        Bgm $bgm,
        Sfx $sfx,
        Volume $volume
    )
    {
        return new GameSetting(
            $gameUserID,
            $bgm,
            $sfx,
            $volume
        );
    }


    /**
     * @param GameUserID $gameUserID
     * @param Volume $volume
     * @param Sfx $sfx
     * @param Bgm $bgm
     * @return GameSetting
     */
    public function init(
        GameUserID $gameUserID,
        Volume $volume,
        Sfx $sfx,
        Bgm $bgm
    ): GameSetting
    {
        return $this->make(
            $gameUserID,
            $bgm,
            $sfx,
            $volume
        );
    }

    /**
     * @param \App\GameSetting $eloquent
     * @return GameSetting
     */
    public function makeByEloquent(\App\GameSetting $eloquent): GameSetting
    {
        $gameUserID = new GameUserID($eloquent->game_user_id);
        $volume = new Volume($eloquent->volume);
        $sfx = new Sfx($eloquent->sfx);
        $bgm = new Bgm($eloquent->bgm);

        return $this->make(
            $gameUserID,
            $bgm,
            $sfx,
            $volume
        );
    }
}