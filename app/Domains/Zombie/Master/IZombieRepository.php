<?php

namespace App\Domains\Zombie\Master;

use Illuminate\Support\Collection;

/**
 * Interface IZombieRepository
 * @package App\Domains\Zombie\Master
 */
interface IZombieRepository
{
    /**
     * Get all zombies.
     * @return Zombie[]|Collection
     */
    public function getAllZombies(): Collection;
}
