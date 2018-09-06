<?php

namespace App\Components\Character;

use App\Domains\Character\CharacterID;
use App\Domains\Character\Having\HavingCharacter;
use App\Domains\Character\Having\HavingCharacterRepository;
use App\Domains\User\GameUserID;
use Illuminate\Support\Collection;

class HavingCharacterComponent
{
    /**
     * @var HavingCharacterRepository
     */
    private $havingCharacterRepository;

    /**
     * @param HavingCharacterRepository $havingCharacterRepository
     */
    public function __construct(
        HavingCharacterRepository $havingCharacterRepository
    )
    {
        $this->havingCharacterRepository = $havingCharacterRepository;
    }

    /**
     * @param GameUserID $gameUserID
     * @return HavingCharacter[] | Collection
     */
    public function getByGameUserID(GameUserID $gameUserID): Collection
    {
        return $this->havingCharacterRepository->findByGameUserID($gameUserID);
    }

    /**
     * @param GameUserID $gameUserID
     * @param CharacterID $characterID
     * @return mixed
     */
    public function addNew(GameUserID $gameUserID, CharacterID $characterID)
    {
        return $this->havingCharacterRepository->persist($gameUserID, $characterID);
    }

}