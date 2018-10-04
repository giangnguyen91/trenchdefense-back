<?php

namespace App\Match\LeaderBoard;

use App\Domains\User\GameUser;
use App\Domains\User\GameUserID;
use App\Domains\User\GameUserRepository;
use App\Domains\Wave\Wave;
use App\Domains\Wave\WaveID;
use App\Domains\Wave\WaveRepository;
use Illuminate\Support\Collection;

class LeaderBoardRepository
{
    /**
     * @var LeaderBoardFactory
     */
    private $leaderBoardFactory;

    /**
     * @param LeaderBoardFactory $leaderBoardFactory
     */
    public function __construct(
        LeaderBoardFactory $leaderBoardFactory
    )
    {
        $this->leaderBoardFactory = $leaderBoardFactory;
    }

    /**
     * @param GameUserID $gameUserID
     * @return LeaderBoard
     */
    public function findByGameUserID(
        GameUserID $gameUserID
    ): ?LeaderBoard
    {
        $eloquent = \App\LeaderBoard::query()->where('game_user_id', $gameUserID->getValue())->first();

        if (is_null($eloquent)) return null;
        return $this->leaderBoardFactory->makeByEloquent($eloquent);
    }

    /**
     * @param int $limit
     * @return LeaderBoard[] | Collection
     */
    public function listTop(int $limit): Collection
    {
        $eloquents = \App\LeaderBoard::query()->orderByDesc('wave_id')->limit($limit)->get();
        return collect($eloquents)->map(function (\App\LeaderBoard $eloquent) {
            return $this->leaderBoardFactory->makeByEloquent($eloquent);
        });
    }

    /**
     * @param LeaderBoard $leaderBoard
     */
    public function persist(LeaderBoard $leaderBoard)
    {
        \App\LeaderBoard::unguarded(function () use ($leaderBoard) {
            return \App\LeaderBoard::query()->updateOrCreate(
                [
                    'game_user_id' => $leaderBoard->getGameUser()->getID()->getValue()
                ],
                [
                    'wave_id' => $leaderBoard->getWave()->getID()->getValue()
                ]
            );
        });
    }

}