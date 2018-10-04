<?php

namespace App\Domains\Match\Action;

use App\Domains\Character\Having\Status\DropGold;
use App\Domains\Character\Hp;
use App\Domains\Match\ResultType;
use App\Domains\User\GameUserID;
use App\Domains\Wave\WaveID;

class EndMatchParameter
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
     * @param Hp $hp
     * @return EndMatchParameter
     */
    public function withHp(Hp $hp)
    {
        $this->hp = $hp;
        return $this;
    }

    /**
     * @param DropGold $dropGold
     * @return EndMatchParameter
     */
    public function withDropGold(DropGold $dropGold)
    {
        $this->dropGold = $dropGold;
        return $this;
    }

    /**
     * @param WaveID $waveID
     * @return EndMatchParameter
     */
    public function withWaveID(WaveID $waveID)
    {
        $this->waveID = $waveID;
        return $this;
    }

    /**
     * @param GameUserID $gameUserID
     * @return EndMatchParameter
     */
    public function withGameUserID(GameUserID $gameUserID)
    {
        $this->gameUserID = $gameUserID;
        return $this;
    }

    /**
     * @param ResultType $resultType
     * @return EndMatchParameter
     */
    public function withResultType(ResultType $resultType)
    {
        $this->resultType = $resultType;
        return $this;
    }
    /**
     * @return EndMatchParameterBuilder
     */
    public function build()
    {
        return new EndMatchParameterBuilder(
            $this->hp,
            $this->dropGold,
            $this->waveID,
            $this->gameUserID,
            $this->resultType
        );
    }
}