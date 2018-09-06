<?php

namespace App\Components\Zombie;

use App\Domains\Zombie\Zombie;
use App\Domains\Zombie\ZombieID;
use App\Domains\Zombie\ZombieRepository;
use Illuminate\Support\Collection;

class ZombieComponent
{
    /**
     * @var ZombieRepository
     */
    private $zombieRepository;

    /**
     * @param ZombieRepository $zombieRepository
     */
    public function __construct(
        ZombieRepository $zombieRepository
    )
    {
        $this->zombieRepository = $zombieRepository;
    }

    /**
     * @return Zombie[] | Collection
     */
    public function getAllZombie(): Collection
    {
        return $this->zombieRepository->all();
    }

    /**
     * @return ZombieID
     */
    public function addNewZombie(Zombie $zombie): ZombieID
    {
        return $this->zombieRepository->persist($zombie);
    }

    /**
     * @param ZombieID $zombieID
     * @return Zombie | null
     */
    public function get(ZombieID $zombieID): ?Zombie
    {
        return $this->zombieRepository->find($zombieID);
    }

    /**
     * @param Zombie $zombie
     * @return mixed
     */
    public function remove(Zombie $zombie)
    {
        return $this->zombieRepository->remove($zombie);
    }
}