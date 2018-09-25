<?php

namespace App\Domains\User\Setting;

use App\Domains\User\GameUserID;

class GameSetting
{
    /**
     * @var GameUserID
     */
    private $gameUserID;

    /**
     * @var Bgm
     */
    private $bgm;

    /**
     * @var Sfx
     */
    private $sfx;

    /**
     * @var Volume
     */
    private $volume;

    /**
     * @param GameUserID $gameUserID
     * @param Bgm $bgm
     * @param Sfx $sfx
     * @param Volume $volume
     */
    public function __construct(
        GameUserID $gameUserID,
        Bgm $bgm,
        Sfx $sfx,
        Volume $volume
    )
    {
        $this->gameUserID = $gameUserID;
        $this->bgm = $bgm;
        $this->sfx = $sfx;
        $this->volume = $volume;
    }

    /**
     * @return  GameUserID
     */
    public function getGameUserID(): GameUserID
    {
        return $this->gameUserID;
    }

    /**
     * @return  Bgm
     */
    public function getBgm(): Bgm
    {
        return $this->bgm;
    }

    /**
     * @return Sfx
     */
    public function getSfx(): Sfx
    {
        return $this->sfx;
    }

    /**
     * @return Volume
     */
    public function getVolume(): Volume
    {
        return $this->volume;
    }

    /**
     * @param  Volume $volume
     * @return GameSetting
     */
    public function setVolume(Volume $volume): GameSetting
    {
        $this->volume = $volume;
        return $this;
    }

    /**
     * @param  Bgm $bgm
     * @return GameSetting
     */
    public function setBgm(Bgm $bgm): GameSetting
    {
        $this->bgm = $bgm;
        return $this;
    }

    /**
     * @param  Sfx $sfx
     * @return GameSetting
     */
    public function setSfx(Sfx $sfx): GameSetting
    {
        $this->sfx = $sfx;
        return $this;
    }
}