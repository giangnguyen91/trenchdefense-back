<?php

namespace App\Components\Character;

use App\Domains\Character\CharacterID;
use App\Domains\Character\Having\HavingCharacter;
use App\Domains\Character\Having\HavingCharacterRepository;
use App\Domains\Character\Having\Status\CharacterStatus;
use App\Domains\Character\Having\Status\CharacterStatusFactory;
use App\Domains\Character\Having\Status\CharacterStatusRepository;
use App\Domains\Character\Having\Status\DropGold;
use App\Domains\User\GameUserID;
use App\Domains\Wave\WaveID;
use Illuminate\Support\Collection;

class CharacterProfileComponent
{
    /**
     * @var CharacterStatusRepository
     */
    private $characterStatusRepository;

    /**
     * @var CharacterStatusFactory
     */
    private $characterStatusFactory;

    /**
     * @param CharacterStatusRepository $characterStatusRepository
     * @param CharacterStatusFactory $characterStatusFactory
     */
    public function __construct(
        CharacterStatusRepository $characterStatusRepository,
        CharacterStatusFactory $characterStatusFactory
    )
    {
        $this->characterStatusRepository = $characterStatusRepository;
        $this->characterStatusFactory = $characterStatusFactory;
    }

    /**
     * @param GameUserID $gameUserID
     * @param WaveID $waveID
     * @return CharacterStatus
     */
    public function initCharacterProfile(
        GameUserID $gameUserID,
        WaveID $waveID
    ) : CharacterStatus
    {
        $characterStatus = $this->characterStatusRepository->findByGameUserID($gameUserID);
        if (!is_null($characterStatus)) {
            $this->characterStatusRepository->removeByGameUserID($gameUserID);
        }

        //Init
        $weapons = config('game.init_weapon');
        $weapons = json_decode($weapons, true);


        $characterStatus = $this->characterStatusFactory->init(
            new CharacterID(1),
            collect($weapons),
            $waveID,
            new DropGold(0),
            $gameUserID
        );

        $this->characterStatusRepository->persist($characterStatus);

        return $characterStatus;
    }



    /**
     * @param GameUserID $gameUserID
     * @return CharacterStatus
     */
    public function getCharacterProfile(
        GameUserID $gameUserID
    ): CharacterStatus
    {
        return $this->characterStatusRepository->findByGameUserID($gameUserID);
    }

    /**
     * @param CharacterStatus $characterStatus
     * @return void
     */
    public function persist(
        CharacterStatus $characterStatus
    )
    {
        $this->characterStatusRepository->persist($characterStatus);
    }
}