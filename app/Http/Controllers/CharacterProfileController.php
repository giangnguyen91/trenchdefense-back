<?php

namespace App\Http\Controllers;


use App\Components\Auth\AuthComponent;
use App\Components\Character\CharacterProfileComponent;
use App\Components\Match\MatchComponent;
use App\Domains\Wave\WaveID;
use App\Proto\EndMatchParameter;
use Illuminate\Http\Request;

class CharacterProfileController extends Controller
{
    /**
     * @var AuthComponent
     */
    private $authComponent;


    /**
     * @var CharacterProfileComponent
     */
    private $characterProfileComponent;

    /**
     * @param AuthComponent $authComponent
     * @param CharacterProfileComponent $characterProfileComponent
     */
    public function __construct(
        AuthComponent $authComponent,
        CharacterProfileComponent $characterProfileComponent
    )
    {
        $this->authComponent = $authComponent;
        $this->characterProfileComponent = $characterProfileComponent;
    }

    public function getCharacterProfile()
    {
        $gameUserID = $this->authComponent->getGameUserId();
        $result = $this->characterProfileComponent->getCharacterProfile($gameUserID);

        return response()->protobuf(
            [
                $result->toProtobuf()
            ]
        );
    }
}