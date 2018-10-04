<?php

namespace App\Match\LeaderBoard;

use App\Domains\User\GameUser;
use App\Domains\Wave\Wave;

class LeaderBoard
{
    /**
     * @var GameUser
     */
    private $gameUser;

    /**
     * @var Wave
     */
    private $wave;

    /**
     * @param GameUser $gameUser
     * @param Wave $wave
     */
    public function __construct(
        GameUser $gameUser,
        Wave $wave
    )
    {
        $this->wave = $wave;
        $this->gameUser = $gameUser;
    }

    /**
     * @return GameUser
     */
    public function getGameUser(): GameUser
    {
        return $this->gameUser;
    }

    /**
     * @return Wave
     */
    public function getWave(): Wave
    {
        return $this->wave;
    }
}