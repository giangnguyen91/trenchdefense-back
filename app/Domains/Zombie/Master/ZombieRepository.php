<?php

namespace App\Domains\Zombie\Master;

use Illuminate\Support\Collection;

/**
 * Class ZombieRepository
 * @package App\Domains\Zombie\Master
 */
class ZombieRepository implements IZombieRepository
{
    /** @var ZombieFactory $zombieFactory */
    private $zombieFactory;

    /**
     * ZombieRepository constructor.
     * @param ZombieFactory $zombieFactory
     */
    public function __construct(ZombieFactory $zombieFactory)
    {
        $this->zombieFactory = $zombieFactory;
    }

    /**
     * @inheritdoc
     */
    public function getAllZombies(): Collection
    {
        return \App\Eloquents\Zombie::query()->get()
            ->map(function (\App\Eloquents\Zombie $zombie) {
                return $this->zombieFactory->makeByEloquent($zombie);
            });
    }
}
