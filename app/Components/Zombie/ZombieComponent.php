<?php

namespace App\Components\Zombie;

use App\Domains\Zombie\Master\IZombieRepository;
use Illuminate\Support\Collection;

/**
 * Class ZombieComponent
 * @package App\Components\Zombie
 */
class ZombieComponent implements IZombieComponent
{
    /**
     * @var IZombieRepository
     */
    private $zombieRepository;

    /**
     * ZombieComponent constructor.
     * @param IZombieRepository $zombieRepository
     */
    public function __construct(IZombieRepository $zombieRepository)
    {
        $this->zombieRepository = $zombieRepository;
    }

    /**
     * @inheritdoc
     */
    public function getAllZombies(): Collection
    {
        return $this->zombieRepository->getAllZombies();
    }
}