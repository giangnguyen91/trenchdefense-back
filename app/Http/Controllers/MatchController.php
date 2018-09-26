<?php

namespace App\Http\Controllers;


use App\Components\Auth\AuthComponent;
use App\Components\Match\MatchComponent;
use App\Domains\Wave\WaveID;

class MatchController extends Controller
{
    /**
    * @var MatchComponent
     */
    private $matchComponent;

    /**
     * @var AuthComponent
     */
    private $authComponent;

    /**
     * @param MatchComponent $matchComponent
     * @param AuthComponent $authComponent
     */
    public function __construct(
        MatchComponent $matchComponent,
        AuthComponent $authComponent
    )
    {
        $this->matchComponent = $matchComponent;
        $this->authComponent = $authComponent;
    }

    public function begin()
    {
        $gameUserID = $this->authComponent->getGameUserId();
        $result = $this->matchComponent->begin($gameUserID, new WaveID(1));

        return response()->protobuf(
            [
                $result->toProtobuf()
            ]
        );
    }
}