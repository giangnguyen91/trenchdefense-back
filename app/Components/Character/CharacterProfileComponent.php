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
use App\Domains\Weapon\Master\Weapon;
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
    ): CharacterStatus
    {
        $characterStatus = $this->characterStatusRepository->findByGameUserID($gameUserID);
        if (!is_null($characterStatus)) {
            $this->characterStatusRepository->removeByGameUserID($gameUserID);

            if ($waveID->getValue() != 1) {
                $weaponIDs = $characterStatus->getWeapons()->map(function (Weapon $weapon) {
                    return $weapon->getId()->getValue();
                });
                $weapons = $weaponIDs->toArray();
                $dropGold = $characterStatus->getDropGold();
                $characterID = $characterStatus->getCharacter()->getId();
            }
        } else {
            //Init
            $weapons = config('game.init_weapon');
            $weapons = json_decode($weapons, true);
            $dropGold = new DropGold(0);
            $characterID = new CharacterID(1);
        }


        $characterStatus = $this->characterStatusFactory->init(
            $characterID,
            collect($weapons),
            $waveID,
            $dropGold,
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