<?php

namespace App\Domains\Wave;

use App\Domains\Base\ResourceID;
use App\Domains\Wave\Zombie\WaveZombie;
use App\Proto\WaveZombie as WaveZombieProto;
use App\Proto\ZombiePosition;
use Illuminate\Support\Collection;

class Wave
{
    const MAX_POSITION = 8;

    const MIN_ZOMBIE = 4;

    const MAX_ZOMBIE = 8;

    /**
     * @var Name
     */
    private $name;

    /**
     * @var WaveID
     */
    private $waveID;

    /**
     * @var ResourceID
     */
    private $resourceID;

    /**
     * @var Collection | WaveZombie[]
     */
    private $waveZombies;

    /**
     * @param Name $name
     * @param WaveID $waveID
     * @param ResourceID $resourceID
     * @param Collection|WaveZombie[] $waveZombies | null
     */
    public function __construct(
        Name $name,
        WaveID $waveID,
        ResourceID $resourceID,
        Collection $waveZombies = null
    )
    {
        $this->name = $name;
        $this->waveID = $waveID;
        $this->resourceID = $resourceID;
        $this->waveZombies = $waveZombies;
    }

    /**
     * @return Name
     */
    public function getName(): Name
    {
        return $this->name;
    }

    /**
     * @return WaveID
     */
    public function getID(): WaveID
    {
        return $this->waveID;
    }

    /**
     * @return ResourceID
     */
    public function getResourceID(): ResourceID
    {
        return $this->resourceID;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return array(
            'id' => $this->getID()->getValue(),
            'name' => $this->getName()->getValue(),
            'resource_id' => $this->getResourceID()->getValue(),
        );
    }

    /**
     * @return \App\Proto\Wave
     */
    public function toProtobuf(): \App\Proto\Wave
    {
        $proto = new \App\Proto\Wave();
        $proto->name = $this->getName()->getValue();
        $proto->resourceID = $this->getResourceID()->getValue();

        $zombies = collect();
        $proto->waveZombies = $this->waveZombies->map(function (WaveZombie $waveZombie) use (&$zombies) {
            $quatity = $waveZombie->getQuantity()->getValue();

            for ($i = 1; $i <= $quatity; $i++) {
                $zombies->push($waveZombie->getZombie());
            }

            return $waveZombie->toProtobuf();
        })->toArray();

        $proto->zombiePositions = $this->generatePosition($zombies)->toArray();

        return $proto;
    }

    /**
     * @return Collection | WaveZombie[] | null
     */
    public function getWaveZombies(): ?Collection
    {
        return $this->waveZombies;
    }

    /**
     * Get locations in random orders
     * @return Collection
     */
    private function getRandomPositions(): Collection
    {
        return collect(range(1, self::MAX_POSITION))->shuffle();
    }

    /**
     * Pop random zombies from zombie list of wave
     * @param Collection $zombies
     * @param int $time
     * @param int $outputQuantity
     * @return Collection
     */
    private function randomZombies(Collection &$zombies, int $time, int $outputQuantity): Collection
    {
        $zombies = $zombies->shuffle();
        $positions = $this->getRandomPositions();
        $zombiePositions = collect();
        for($i = 0; $i < $outputQuantity; $i++){
            $zombie = $zombies->shift();

            if(!is_null($zombie)){
                $zombiePosition = new ZombiePosition();
                $zombiePosition->time = $time;
                $zombiePosition->position = $positions[$i];
                $zombiePosition->zombie = $zombie;

                $zombiePositions->push($zombiePosition);
            }
        }

        return $zombiePositions;
    }

    /**
     * @param Collection $zombies
     * @param int $time
     * @return Collection
     */
    private function generatePosition(Collection &$zombies, int $time = 0): Collection
    {
        $zombiePositions = collect();
        $outputQuantity = mt_rand(self::MIN_ZOMBIE, self::MAX_ZOMBIE);
        $randomZombies = $this->randomZombies($zombies, $time, $outputQuantity);
        $zombiePositions = $zombiePositions->merge($randomZombies);

        if($zombies->isNotEmpty()){
            $zombiePositions = $zombiePositions->merge($this->generatePosition($zombies, $time + config('game.increaseTime')));
        }

        return $zombiePositions;
    }
}