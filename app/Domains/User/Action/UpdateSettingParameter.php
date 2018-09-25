<?php

namespace App\Domains\User\Action;

use App\Domains\User\GameUserID;
use App\Domains\User\GameUserName;
use App\Domains\User\Setting\Bgm;
use App\Domains\User\Setting\Sfx;
use App\Domains\User\Setting\Volume;

class UpdateSettingParameter
{
    /**
     * @var GameUserName
     */
    private $gameUserName;

    /**
     * @var Volume
     */
    private $volume;

    /**
     * @var Sfx
     */
    private $sfx;

    /**
     * @var Bgm
     */
    private $bgm;

    /**
     * @var GameUserID
     */
    private $gameUserID;

    /**
     * @param GameUserName $name
     * @return UpdateSettingParameter
     */
    public function withName(GameUserName $name)
    {
        $this->gameUserName = $name;
        return $this;
    }

    /**
     * @param Volume $volume
     * @return UpdateSettingParameter
     */
    public function withVolume(Volume $volume)
    {
        $this->volume = $volume;
        return $this;
    }

    /**
     * @param Sfx $sfx
     * @return UpdateSettingParameter
     */
    public function withSfx(Sfx $sfx)
    {
        $this->sfx = $sfx;
        return $this;
    }

    /**
     * @param Bgm $bgm
     * @return UpdateSettingParameter
     */
    public function withBgm(Bgm $bgm)
    {
        $this->bgm = $bgm;
        return $this;
    }

    /**
     * @param GameUserID $gameUserID
     * @return UpdateSettingParameter
     */
    public function withGameUserID(GameUserID $gameUserID)
    {
        $this->gameUserID = $gameUserID;
        return $this;
    }

    /**
     * @return UpdateSettingParameterBuilder
     */
    public function build()
    {
        return new UpdateSettingParameterBuilder(
            $this->gameUserName,
            $this->volume,
            $this->sfx,
            $this->bgm,
            $this->gameUserID
        );
    }


}