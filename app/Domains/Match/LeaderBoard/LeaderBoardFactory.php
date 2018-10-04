<?php

namespace App\Match\LeaderBoard;

use App\Domains\User\GameUser;
use App\Domains\Wave\Wave;

class LeaderBoardFactory
{

    /**
     * @param GameUser $gameUser
     * @param Wave $wave
     * @return LeaderBoard
     */
    public function make(
        GameUser $gameUser,
        Wave $wave
    ) : LeaderBoard
    {
        return new LeaderBoard(
            $gameUser,
            $wave
        );
    }

    /**
     * @param GameUser $gameUser
     * @param Wave $wave
     * @return LeaderBoard
     */
    public function init(
        GameUser $gameUser,
        Wave $wave
    ): LeaderBoard
    {
        return $this->make($gameUser, $wave);
    }

    /**
     * @return LeaderBoard
     */
    public function makeByEloquent(): LeaderBoard
    {
        return $this->wave;
    }
}