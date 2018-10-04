<?php

namespace App\Components\Match;

use App\Components\Character\CharacterProfileComponent;
use App\Components\Wave\WaveComponent;
use App\Components\Weapon\WeaponComponent;
use App\Domains\Character\Having\Status\CharacterStatus;
use App\Domains\Character\Having\Status\CharacterStatusFactory;
use App\Domains\Character\Having\Status\CharacterStatusRepository;
use App\Domains\Match\Action\EndMatchParameterBuilder;
use App\Domains\User\GameUserID;
use App\Domains\Wave\WaveID;

class MatchComponent
{
    /**
     * @var CharacterProfileComponent
     */
    private $characterProfileComponent;

    /**
     * @var WeaponComponent
     */
    private $weaponComponent;

    /**
     * @var WaveComponent
     */
    private $waveComponent;

    /**
     * @param CharacterProfileComponent $characterProfileComponent
     * @param WeaponComponent $weaponComponent
     * @param WaveComponent $waveComponent
     */
    public function __construct(
        CharacterProfileComponent $characterProfileComponent,
        WeaponComponent $weaponComponent,
        WaveComponent $waveComponent
    )
    {
        $this->characterProfileComponent = $characterProfileComponent;
        $this->weaponComponent = $weaponComponent;
        $this->waveComponent = $waveComponent;
    }

    /**
     * @param GameUserID $gameUserID
     * @param WaveID $waveID
     * @return CharacterStatus
     */
    public function begin(
        GameUserID $gameUserID,
        WaveID $waveID
    ): CharacterStatus
    {
        return $this->characterProfileComponent->initCharacterProfile($gameUserID, $waveID);
    }


    /**
     * @param EndMatchParameterBuilder $parameter
     * @return CharacterStatus
     */
    public function end(
        EndMatchParameterBuilder $parameter
    ): CharacterStatus
    {
        $characterProfile = $this->characterProfileComponent->getCharacterProfile($parameter->getGameUserID());
        $wave = $this->waveComponent->get($parameter->getWaveID());

        $characterWeapon = $characterProfile->getWeapons();

        $availableWeapon = config('game.weapon_available');

        $availableWeapon = json_decode($availableWeapon, true);

        $nextWaveID = new WaveID($parameter->getWaveID()->getValue() + 1);

        $weaponIDs = isset($availableWeapon[$nextWaveID->getValue()]) ?
            $availableWeapon[$nextWaveID->getValue()] : array();
        $availableWeapons = $this->weaponComponent->findByWeaponIDs(collect($weaponIDs));
        $weapons = $characterWeapon->merge($availableWeapons);

        $newProfile = $characterProfile->addGold($parameter->getDropGold())
            ->setHp($parameter->getHp())
            ->setWeapons($weapons)
            ->setWave($wave);

        $this->characterProfileComponent->persist($newProfile);

        return $newProfile;
    }
}