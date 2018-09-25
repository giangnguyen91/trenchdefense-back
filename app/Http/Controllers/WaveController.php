<?php

namespace App\Http\Controllers;

use App\Components\Wave\WaveComponent;
use App\Domains\Wave\Wave;

class WaveController extends Controller
{
    /**
     * @var WaveComponent
     */
    private $waveComponent;

    /**
     * @var WaveComponent $waveComponent
     */
    public function __construct(
        WaveComponent $waveComponent
    )
    {
        $this->waveComponent = $waveComponent;
    }

    public function get(int $page)
    {
        $waves = $this->waveComponent->listWaves($page);
        return response()->protobuf([$waves->toProtobuf()]);
    }
}
