<?php

namespace App\Http\Controllers;

use App\Components\Auth\AuthComponent;
use App\Domains\Character\Having\Status\DropGold;
use App\Domains\Character\Hp;
use App\Domains\Match\Action\EndMatchParameter as EndMatchParameterAction;
use App\Components\Match\MatchComponent;
use App\Domains\Match\ResultType;
use App\Domains\User\GameUserID;
use App\Domains\Wave\WaveID;
use App\Proto\BeginMatchParameter;
use App\Proto\EndMatchParameter;
use Illuminate\Http\Request;

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

    public function begin(Request $request)
    {
        $parameter = $request->get(BeginMatchParameter::class);
        $gameUserID = $this->authComponent->getGameUserId();
        $result = $this->matchComponent->begin($gameUserID, new WaveID($parameter->waveID));

        return response()->protobuf(
            [
                $result->toProtobuf()
            ]
        );
    }

    public function end(Request $request)
    {
        $gameUserID = $this->authComponent->getGameUserId();
        $parameter = $request->get(EndMatchParameter::class);

        $endMatchParameter = (new EndMatchParameterAction())
            ->withGameUserID($gameUserID)
            ->withDropGold(new DropGold($parameter->dropGold))
            ->withHp(new Hp($parameter->hp))
            ->withWaveID(new WaveID($parameter->waveID))
            ->withResultType(new ResultType($parameter->matchResult))
            ->build();

        $result = $this->matchComponent->end($endMatchParameter);

        return response()->protobuf(
            [
                $result->toProtobuf()
            ]
        );


    }
}