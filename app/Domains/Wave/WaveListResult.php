<?php

namespace App\Domains\Wave;

use Illuminate\Support\Collection;

class WaveListResult
{
    /**
     * @var int
     */
    private $totalPage;

    /**
     * @var Collection | Wave[]
     */
    private $waves;

    /**
     * @param int $totalPage
     * @param  Collection | Wave[] $waves
     */
    public function __construct(
        int $totalPage,
        Collection $waves
    )
    {
        $this->totalPage = $totalPage;
        $this->waves = $waves;
    }

    /**
     * @return \App\Proto\WaveListResult
     */
    public function toProtobuf(): \App\Proto\WaveListResult
    {
        $proto = new \App\Proto\WaveListResult();
        $proto->totalPage = $this->totalPage;
        $proto->waves = $this->waves->map(function (Wave $wave) {
            return $wave->toProtobuf();
        })->toArray();

        return $proto;
    }
}