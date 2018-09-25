<?php

namespace App\Domains\Wave;

use App\Domains\Base\ResourceID;
use App\Domains\Wave\Zombie\WaveZombie;
use App\Proto\Position;
use App\Proto\ZombiePosition;
use Illuminate\Support\Collection;

class Wave
{
    const MAX_POSITION = 8;

    const MIN_ZOMBIE = 4;

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
                $zombies->push($waveZombie->getZombie()->getID()->getValue());
            }
            return $waveZombie->toProtobuf();
        })->toArray();
        $proto->zombiePosition = $this->generatePosition($zombies);

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
     * @param Collection $zombies
     * @return array
     */
    private function generatePosition(Collection $zombies): array
    {
        $positionBase = range(1, self::MAX_POSITION);
        $zombieCount = $zombies->count();

        $data = [];
        $time = 0;
        while ($zombieCount) {
            $zombies = $zombies->shuffle();

            if ($zombies->count() >= self::MIN_ZOMBIE) {
                $zombieList = $zombies->slice(0, self::MIN_ZOMBIE);
            } else {
                $zombieList = $zombies->slice(0, $zombies->count() - 1);
            }

            $zombies = $zombies->diffKeys($zombieList);

            $randomNumber = rand(self::MIN_ZOMBIE, self::MAX_POSITION);
            $randomPositions = array_rand($positionBase, $randomNumber);

            $position = [];
            while ($randomNumber) {
                $this->shuffleRandomize($zombieList, $randomNumber, $position, $randomPositions);
            }

            $increaseTime = config('game.increaseTime');

            $newZombiePosition = new ZombiePosition();
            $newZombiePosition->position = $position;
            $newZombiePosition->time = $time;
            $data[$time] = $newZombiePosition;
            $time = $time + $increaseTime;
            $zombieCount = $zombies->count();

        }
        return $data;
    }

    private function shuffleRandomize(Collection $zombieList, &$randomNumber, &$position, &$randomPositions)
    {
        $zombieList = $zombieList->shuffle();
        $zombieDetail = $zombieList->shift();

        shuffle($randomPositions);
        $positionRandom = array_shift($randomPositions);

        $modelPosition = new Position();
        $modelPosition->zombieID = $zombieDetail;
        $modelPosition->zombieName = 'sss';
        $modelPosition->total = 1;
        $position[$positionRandom] = $modelPosition;
        $randomNumber--;
    }
}