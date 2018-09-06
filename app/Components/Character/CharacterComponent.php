<?php

namespace App\Components\Character;

use App\Domains\Character\Character;
use App\Domains\Character\CharacterID;
use App\Domains\Character\CharacterRepository;
use Illuminate\Support\Collection;

class CharacterComponent
{
    /**
     * @var CharacterRepository
     */
    private $characterRepository;

    /**
     * @param CharacterRepository $characterRepository
     */
    public function __construct(
        CharacterRepository $characterRepository
    )
    {
        $this->characterRepository = $characterRepository;
    }

    /**
     * @return Character[] | Collection
     */
    public function getAll(): Collection
    {
        return $this->characterRepository->all();
    }

    /**
     * @param Character $character
     * @return CharacterID
     */
    public function addNew(Character $character): CharacterID
    {
        return $this->characterRepository->persist($character);
    }

    /**
     * @param CharacterID $characterID
     * @return Character | null
     */
    public function get(CharacterID $characterID): ?Character
    {
        return $this->characterRepository->find($characterID);
    }

    /**
     * @param Character $character
     * @return mixed
     */
    public function remove(Character $character)
    {
        return $this->characterRepository->remove($character);
    }
}