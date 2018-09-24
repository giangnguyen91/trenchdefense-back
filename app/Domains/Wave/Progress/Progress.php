<?php

namespace App\Domains\Wave\Progress;

use App\Domains\User\GameUser;
use App\Domains\Wave\Wave;

class Progress
{
    /**
     * @var Wave
     */
    private $wave;

    /**
     * @var GameUser
     */
    private $gameUser;

    /**
     * @var Status
     */
    private $status;

    /**
     * @param Wave $wave
     * @param GameUser $gameUser
     * @param Status $status
     */
    public function __construct(
        Wave $wave,
        GameUser $gameUser,
        Status $status
    )
    {
        $this->wave = $wave;
        $this->gameUser = $gameUser;
        $this->status = $status;
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

    /**
     * @return Status
     */
    public function getStatus(): Status
    {
        return $this->status;
    }
}