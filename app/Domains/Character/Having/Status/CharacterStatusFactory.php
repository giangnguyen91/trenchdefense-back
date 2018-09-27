<?php

namespace App\Domains\Character\Having\Status;

use App\Domains\Character\Character;
use App\Domains\Character\CharacterID;
use App\Domains\Character\CharacterRepository;
use App\Domains\Character\Hp;
use App\Domains\User\GameUserID;
use App\Domains\Wave\Wave;
use App\Domains\Wave\WaveID;
use App\Domains\Wave\WaveRepository;
use App\Domains\Weapon\Master\WeaponRepository;
use Illuminate\Support\Collection;

class CharacterStatusFactory
{
    /**
     * @var  CharacterRepository
     */
    private $characterRepository;

    /**
     * @var WeaponRepository
     */
    private $weaponRepository;

    /**
     * @var WaveRepository
     */
    private $waveRepository;

    /**
     * @param CharacterRepository $characterRepository
     * @param WeaponRepository $weaponRepository
     * @param WaveRepository $waveRepository
     */
    public function __construct(
        CharacterRepository $characterRepository,
        WeaponRepository $weaponRepository,
        WaveRepository $waveRepository
    )
    {
        $this->characterRepository = $characterRepository;
        $this->weaponRepository = $weaponRepository;
        $this->waveRepository = $waveRepository;
    }

    /**
     * @param Character $character
     * @param GameUserID $gameUserID
     * @param Collection $weapons
     * @param Wave $wave
     * @param DropGold $dropGold
     * @param Hp $hp
     * @return CharacterStatus
     */
    public function make(
        Character $character,
        GameUserID $gameUserID,
        Collection $weapons,
        Wave $wave,
        DropGold $dropGold,
        Hp $hp
    )
    {
        return new CharacterStatus(
            $character,
            $gameUserID,
            $weapons,
            $wave,
            $dropGold,
            $hp
        );
    }

    /**
     * @param CharacterID $characterID
     * @param Collection $weapons
     * @param WaveID $waveID
     * @param DropGold $dropGold
     * @param GameUserID $gameUserID
     * @return CharacterStatus
     */
    public function init(
        CharacterID $characterID,
        Collection $weapons,
        WaveID $waveID,
        DropGold $dropGold,
        GameUserID $gameUserID
    ): CharacterStatus
    {
        $character = $this->characterRepository->find($characterID);
        $weapons = $this->weaponRepository->findByWeaponIDs($weapons);
        $wave = $this->waveRepository->find($waveID);

        return $this->make(
            $character,
            $gameUserID,
            $weapons,
            $wave,
            $dropGold,
            $character->getHp()
        );
    }


    /**
     * @param \App\CharacterStatus $eloquent
     * @return CharacterStatus
     */
    public function makeByEloquent(\App\CharacterStatus $eloquent): CharacterStatus
    {
        $character = $this->characterRepository->find(new CharacterID($eloquent->character_id));
        $weapons = !is_null($eloquent->weapons) ? json_decode($eloquent->weapons, true) : array();

        $weapons = $this->weaponRepository->findByWeaponIDs(collect($weapons));
        $wave = $this->waveRepository->find(new WaveID($eloquent->wave_id));

        return $this->make(
            $character,
            new GameUserID($eloquent->game_user_id),
            $weapons,
            $wave,
            new DropGold($eloquent->drop_gold),
            new Hp($eloquent->hp)
        );
    }
}