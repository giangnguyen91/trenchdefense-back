<?php

namespace App\Domains\Wave;

use App\Domains\Base\ResourceID;
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
     * @param Name $name
     * @param WaveID $waveID
     * @param ResourceID $resourceID
     */
    public function __construct(
        Name $name,
        WaveID $waveID,
        ResourceID $resourceID
    )
    {
        $this->name = $name;
        $this->waveID = $waveID;
        $this->resourceID = $resourceID;
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
}