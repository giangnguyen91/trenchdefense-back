<?php

namespace App\Domains\Character;

use Illuminate\Support\Collection;

class CharacterRepository
{
    /**
     * @var CharacterFactory
     */
    private $characterFactory;

    /**
     * @param CharacterFactory $characterFactory
     */
    public function __construct(
        CharacterFactory $characterFactory
    )
    {
        $this->characterFactory = $characterFactory;
    }

    /**
     * @param CharacterID $characterID
     * @return Character | null
     */
    public function find(
        CharacterID $characterID
    ): ?Character
    {
        $characterEloquent = \App\Character::query()->where('id', $characterID->getValue())->first();

        if (is_null($characterEloquent)) return null;
        return $this->characterFactory->makeByEloquent($characterEloquent);
    }

    /**
     * @param Character $character
     * @return CharacterID
     */
    public function persist(
        Character $character
    ): CharacterID
    {
        $eloquent = \App\Character::unguarded(function () use ($character) {
            return \App\Character::query()->updateOrCreate(
                [
                    'id' => !is_null($character->getId()->getValue()) ? $character->getId()->getValue() : null
                ],
                [
                    'name' => $character->getName()->getValue(),
                    'hp' => $character->getHp()->getValue(),
                    'speed' => $character->getSpeed()->getValue(),
                    'attack' => $character->getAttack()->getValue(),
                    'resource_id' => $character->getResourceID()->getValue()
                ]
            );
        });

        return new CharacterID($eloquent->id);
    }

    /**
     * @return Character[] | Collection
     */
    public function all(): Collection
    {
        $characterEloquents = \App\Character::query()->get();
        return collect($characterEloquents)->map(function (\App\Character $eloquent) {
            return $this->characterFactory->makeByEloquent($eloquent);
        });
    }

    /**
     * @param Character $character
     * @return mixed
     */
    public function remove(Character $character)
    {
        \App\Character::destroy($character->getID()->getValue());
    }
}