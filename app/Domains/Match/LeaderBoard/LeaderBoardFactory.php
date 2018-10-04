<?php

namespace App\Match\LeaderBoard;

use App\Domains\User\GameUser;
use App\Domains\User\GameUserID;
use App\Domains\User\GameUserRepository;
use App\Domains\Wave\Wave;
use App\Domains\Wave\WaveID;
use App\Domains\Wave\WaveRepository;

class LeaderBoardFactory
{
    /**
     * @var GameUserRepository
     */
    private $gameUserRepository;

    /**
     * @var WaveRepository
     */
    private $waveRepository;

    /**
     * @param GameUserRepository $gameUserRepository
     * @param WaveRepository $waveRepository
     */
    public function __construct(
        GameUserRepository $gameUserRepository,
        WaveRepository $waveRepository
    )
    {
        $this->gameUserRepository = $gameUserRepository;
        $this->waveRepository = $waveRepository;
    }

    /**
     * @param GameUser $gameUser
     * @param Wave $wave
     * @return LeaderBoard
     */
    public function make(
        GameUser $gameUser,
        Wave $wave
    ): LeaderBoard
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
    public function makeByEloquent(
        \App\LeaderBoard $eloquent
    ): LeaderBoard
    {
        $wave = $this->waveRepository->find(new WaveID($eloquent->wave_id));
        $gameUser = $this->gameUserRepository->findByID(new GameUserID($eloquent->game_user_id));
        return $this->make(
            $gameUser,
            $wave
        );
    }
}