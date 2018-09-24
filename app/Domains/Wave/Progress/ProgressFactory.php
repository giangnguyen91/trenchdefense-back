<?php

namespace App\Domains\Wave\Progress;

use App\Domains\User\GameUser;
use App\Domains\User\GameUserID;
use App\Domains\User\GameUserRepository;
use App\Domains\Wave\Wave;
use App\Domains\Wave\WaveID;
use App\Domains\Wave\WaveRepository;
use App\WaveProgress;

class ProgressFactory
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
     * @param Wave $wave
     * @param GameUser $gameUser
     * @param Status $status
     * @return Progress
     */
    public function make(
        Wave $wave,
        GameUser $gameUser,
        Status $status
    ): Progress
    {
        return new Progress(
            $wave,
            $gameUser,
            $status
        );
    }

    /**
     * @param WaveID $waveID
     * @param GameUserID $gameUserID
     * @param Status $status
     * @return Progress
     */
    public function init(
        WaveID $waveID,
        GameUserID $gameUserID,
        Status $status
    ): Progress
    {

        $wave = $this->waveRepository->find($waveID);
        $gameUser = $this->gameUserRepository->findByID($gameUserID);

        return $this->make(
            $wave,
            $gameUser,
            $status
        );
    }

    /**
     * @param WaveProgress $eloquent
     * @return Progress
     */
    public function makeByEloquent(
        WaveProgress $eloquent
    ): Progress
    {
        $wave = $this->waveRepository->find(new WaveID($eloquent->wave_id));
        $gameUser = $this->gameUserRepository->findByID(new GameUserID($eloquent->game_user_id));
        $status = new Status($eloquent->status);

        return $this->make(
            $wave,
            $gameUser,
            $status
        );
    }
}