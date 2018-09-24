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


    private function generatePosition(Collection $zombies): array
    {
        $start = 0;

        $positionBase = range(1, self::MAX_POSITION);
        $randomNumber = rand(self::MIN_ZOMBIE, self::MAX_POSITION);
        $zombieCount = $zombies->count();

        $data = [];
        while ($zombieCount > 0) {
            $randomPositions = array_rand($positionBase, $randomNumber);

            if (!$zombies->count()) {
                $zombieCount = 0;
            } else {
                if ($zombies->count() > self::MAX_POSITION) {
                    $zombieList = $zombies->random($randomNumber)->unique();
                } else {
                    $zombieList = $zombies->random(1);
                }

                $arr = [];
                foreach ($zombieList as $item) {
                    $total = isset($arr[$item]) ? $arr[$item] + 1 : 1;
                    $arr[$item] = $total;
                    $indexRemove = $zombies->search($item);
                    $zombies = $zombies->forget($indexRemove);
                }

                $position = [];

                foreach ($arr as $id => $count) {
                    $waveZombieInfo = $this->waveZombies->filter(function (WaveZombie $waveZombie) use ($id) {
                        return $waveZombie->getZombie()->getID()->getValue() == $id;
                    })->first();
                    $positionModel = new Position();
                    $positionModel->zombieID = $id;
                    $positionModel->zombieName = $waveZombieInfo->getZombie()->getName()->getValue();
                    $positionModel->total = $count;
                    $randPosition = $randomPositions[mt_rand(0, count($randomPositions) - 1)];
                    $position[$randPosition] = $positionModel;
                    $zombieCount = $zombieCount - $count;
                }

                if (!empty($position)) {
                    $zombiePosition = new ZombiePosition();
                    $zombiePosition->position = $position;
                    $zombiePosition->time = $start;
                    $data[] = $zombiePosition;
                    $start = $start + config('game.increaseTime');
                }
            }
        }
        return $data;
    }
}