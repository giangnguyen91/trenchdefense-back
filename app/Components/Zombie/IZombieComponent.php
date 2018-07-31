<?php

namespace App\Components\Zombie;

use App\Domains\Zombie\Master\Zombie;
use Illuminate\Support\Collection;

/**
 * Interface IZombieComponent
 * @package App\Components\Zombie
 */
interface IZombieComponent
{
    /**
     * Get all zombies.
     * @return Zombie[]|Collection
     */
    public function getAllZombies(): Collection;
}
