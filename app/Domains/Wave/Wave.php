<?php

namespace App\Domains\Wave;

use App\Domains\Base\ResourceID;
use App\Domains\Wave\Zombie\WaveZombie;
use Illuminate\Support\Collection;

class Wave
{
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
        $proto->waveZombies = $this->waveZombies->map(function (WaveZombie $waveZombie) {
            return $waveZombie->toProtobuf();
        })->toArray();
        return $proto;
    }

    /**
     * @return Collection | WaveZombie[] | null
     */
    public function getWaveZombies(): ?Collection
    {
        return $this->waveZombies;
    }
}