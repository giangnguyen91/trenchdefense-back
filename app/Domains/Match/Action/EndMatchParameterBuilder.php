<?php

namespace App\Domains\Match\Action;

use App\Domains\Character\Having\Status\DropGold;
use App\Domains\Character\Hp;
use App\Domains\Match\ResultType;
use App\Domains\User\GameUserID;
use App\Domains\Wave\WaveID;

class EndMatchParameterBuilder
{
    /**
     * @var Hp
     */
    private $hp;

    /**
     * @var DropGold
     */
    private $dropGold;

    /**
     * @var WaveID
     */
    private $waveID;

    /**
     * @var GameUserID
     */
    private $gameUserID;

    /**
     * @var ResultType
     */
    private $resultType;

    /**
     * @param  Hp $hp
     * @param  DropGold $dropGold
     * @param  WaveID $waveID
     * @param  GameUserID $gameUserID
     */
    public function __construct(
        Hp $hp,
        DropGold $dropGold,
        WaveID $waveID,
        GameUserID $gameUserID,
        ResultType $resultType
    )
    {
        $this->hp = $hp;
        $this->dropGold = $dropGold;
        $this->waveID = $waveID;
        $this->gameUserID = $gameUserID;
        $this->resultType = $resultType;
    }

    /**
     * @return GameUserID
     */
    public function getGameUserID()
    {
        return $this->gameUserID;
    }

    /**
     * @return Hp
     */
    public function getHp()
    {
        return $this->hp;
    }

    /**
     * @return WaveID
     */
    public function getWaveID()
    {
        return $this->waveID;
    }

    /**
     * @return DropGold
     */
    public function getDropGold()
    {
        return $this->dropGold;
    }

    /**
     * @return ResultType
     */
    public function getResultType()
    {
        return $this->resultType;
    }
}