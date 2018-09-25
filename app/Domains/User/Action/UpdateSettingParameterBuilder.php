<?php

namespace App\Domains\User\Action;

use App\Domains\User\GameUserID;
use App\Domains\User\GameUserName;
use App\Domains\User\Setting\Bgm;
use App\Domains\User\Setting\Sfx;
use App\Domains\User\Setting\Volume;

class UpdateSettingParameterBuilder
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
     * @param  GameUserName $gameUserName
     * @param  Volume $volume
     * @param  Sfx $sfx
     * @param  Bgm $bgm
     * @param  GameUserID $gameUserID
     */
    public function __construct(
        GameUserName $gameUserName,
        Volume $volume,
        Sfx $sfx,
        Bgm $bgm,
        GameUserID $gameUserID
    )
    {
        $this->gameUserName = $gameUserName;
        $this->volume = $volume;
        $this->sfx = $sfx;
        $this->bgm = $bgm;
        $this->gameUserID = $gameUserID;
    }

    /**
     * @return GameUserName
     */
    public function getName()
    {
        return $this->gameUserName;
    }

    /**
     * @return Volume
     */
    public function getVolume()
    {
        return $this->volume;
    }

    /**
     * @return Sfx
     */
    public function getSfx()
    {
        return $this->sfx;
    }

    /**
     * @return Bgm
     */
    public function getBgm()
    {
        return $this->bgm;
    }

    /**
     * @return GameUserID
     */
    public function getGameUserID()
    {
        return $this->gameUserID;
    }
}