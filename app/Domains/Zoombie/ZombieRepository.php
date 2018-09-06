<?php

namespace App\Domains\Zombie;

use Illuminate\Support\Collection;

class ZombieRepository
{
    /**
     * @var ZombieFactory
     */
    private $zombieFactory;

    /**
     * @param ZombieFactory $zombieFactory
     */
    public function __construct(
        ZombieFactory $zombieFactory
    )
    {
        $this->zombieFactory = $zombieFactory;
    }

    /**
     * @param ZombieID $zombieID
     * @return Zombie | null
     */
    public function find(
        ZombieID $zombieID
    ): ?Zombie
    {
        $zombieEloquent = \App\Zombie::query()->where('id', $zombieID->getValue())->first();

        if (is_null($zombieEloquent)) return null;
        return $this->zombieFactory->makeByEloquent($zombieEloquent);
    }

    /**
     * @param Zombie $zombie
     * @return ZombieID
     */
    public function persist(
        Zombie $zombie
    ): ZombieID
    {
        $eloquent = \App\Zombie::unguarded(function () use ($zombie) {
            return \App\Zombie::query()->updateOrCreate(
                [
                    'id' => !is_null($zombie->getId()->getValue()) ? $zombie->getId()->getValue() : null
                ],
                [
                    'name' => $zombie->getName()->getValue(),
                    'damage' => $zombie->getDamage()->getValue(),
                    'hp' => $zombie->getHp()->getValue(),
                    'speed' => $zombie->getSpeed()->getValue(),
                    'attack' => $zombie->getAttack()->getValue(),
                    'drop_gold' => $zombie->getDropGold()->getValue()
                ]
            );
        });

        return new ZombieID($eloquent->id);
    }

    /**
     * @return Zombie[] | Collection
     */
    public function all(): Collection
    {
        $zombieEloquents = \App\Zombie::query()->get();
        return collect($zombieEloquents)->map(function (\App\Zombie $eloquent) {
            return $this->zombieFactory->makeByEloquent($eloquent);
        });
    }

    /**
     * @param Zombie $zombie
     * @return mixed
     */
    public function remove(Zombie $zombie)
    {
        \App\Zombie::destroy($zombie->getID()->getValue());
    }

    /**
     * @param Collection $zombieIDs
     * @return Collection
     */
    public function findByZombieIDs(
        Collection $zombieIDs
    ): ?Collection
    {
        $zombiesEloquent = \App\Zombie::query()->whereIn('id', $zombieIDs->toArray())->get();

        return collect($zombiesEloquent)->map(function (\App\Zombie $eloquent) {
            return $this->zombieFactory->makeByEloquent($eloquent);
        });
    }
}