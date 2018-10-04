<?php

namespace App\Components\Match;

use App\Components\Character\CharacterProfileComponent;
use App\Components\User\UserComponent;
use App\Components\Wave\WaveComponent;
use App\Components\Weapon\WeaponComponent;
use App\Domains\Character\Having\Status\CharacterStatus;
use App\Domains\Character\Having\Status\CharacterStatusFactory;
use App\Domains\Character\Having\Status\CharacterStatusRepository;
use App\Domains\Match\Action\EndMatchParameterBuilder;
use App\Domains\Match\ResultType;
use App\Domains\User\GameUserID;
use App\Domains\Wave\WaveID;
use App\Match\LeaderBoard\LeaderBoard;
use App\Match\LeaderBoard\LeaderBoardFactory;
use App\Match\LeaderBoard\LeaderBoardRepository;
use Illuminate\Support\Collection;

class LeaderBoardComponent
{
    const LIMIT = 10;

    /**
     * @var LeaderBoardRepository
     */
    private $leaderBoardRepository;

    /**
     * @var LeaderBoardFactory
     */
    private $leaderBoardFactory;

    /**
     * @var UserComponent
     */
    private $userComponent;

    /**
     * @var WaveComponent
     */
    private $waveComponent;

    /**
     * @param LeaderBoardRepository $leaderBoardRepository
     * @param UserComponent $userComponent
     * @param WaveComponent $waveComponent
     * @param LeaderBoardFactory $leaderBoardFactory
     */
    public function __construct(
        LeaderBoardRepository $leaderBoardRepository,
        UserComponent $userComponent,
        WaveComponent $waveComponent,
        LeaderBoardFactory $leaderBoardFactory
    )
    {
        $this->leaderBoardRepository = $leaderBoardRepository;
        $this->userComponent = $userComponent;
        $this->waveComponent = $waveComponent;
        $this->leaderBoardFactory = $leaderBoardFactory;
    }

    /**
     * @param GameUserID $gameUserID
     * @return LeaderBoard | null
     */
    public function getByGameUserID(
        GameUserID $gameUserID
    ): ?LeaderBoard
    {
        return $this->leaderBoardRepository->findByGameUserID($gameUserID);
    }


    /**
     * @return Collection
     */
    public function listTop(): Collection
    {
        return $this->leaderBoardRepository->listTop(self::LIMIT);

    }

    /**
     * @param GameUserID $gameUserID
     * @param WaveID $waveID
     */
    public function persistLeaderBoard(
        GameUserID $gameUserID,
        WaveID $waveID
    )
    {
        $leaderBoard = $this->getByGameUserID($gameUserID);

        $gameUser = $this->userComponent->find($gameUserID);
        $wave = $this->waveComponent->get($waveID);

        if (is_null($leaderBoard)) {
            $leaderBoard = $this->leaderBoardFactory->init($gameUser, $wave);
        } else {
            if ($leaderBoard->getWave()->getID()->getValue() < $waveID->getValue()) {
                $leaderBoard = $leaderBoard->setWave($wave);
            }
        }
        $this->leaderBoardRepository->persist($leaderBoard);
    }
}