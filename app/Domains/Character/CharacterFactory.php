<?php

namespace App\Domains\Character;

use App\Domains\Base\ResourceID;

class CharacterFactory
{

    /**
     * @param  CharacterID $characterID
     * @param  Attack $attack
     * @param  Speed $speed
     * @param  Hp $hp
     * @param  Name $name
     * @param  ResourceID $resourceID
     * @return Character
     */
    public function make(
        CharacterID $characterID,
        Attack $attack,
        Speed $speed,
        Hp $hp,
        Name $name,
        ResourceID $resourceID
    )
    {
        return new Character(
            $characterID,
            $attack,
            $speed,
            $hp,
            $name,
            $resourceID
        );
    }

    /**
     * @param \App\Character $eloquent
     * @return  Character
     */
    public function makeByEloquent(
        \App\Character $eloquent
    ): Character
    {
        return $this->make(
            new CharacterID($eloquent->id),
            new Attack($eloquent->attack),
            new Speed($eloquent->speed),
            new Hp($eloquent->hp),
            new Name($eloquent->name),
            new ResourceID($eloquent->resource_id)
        );
    }

    /**
     * @param array $array
     * @return Character
     */
    public function makeByArray(array $array): Character
    {
        $characterID = !empty($array['id']) ? new CharacterID($array['id']) : new CharacterID(null);
        return $this->make(
            $characterID,
            new Attack($array['attack']),
            new Speed($array['speed']),
            new Hp($array['hp']),
            new Name($array['name']),
            new ResourceID($array['resource_id'])
        );
    }
}