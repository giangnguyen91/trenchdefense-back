<?php

namespace App\Http\Controllers;

use App\Components\Auth\AuthComponent;
use App\Components\Character\HavingCharacterComponent;
use App\Domains\Character\Having\HavingCharacter;

class HavingCharacterController extends Controller
{
    /**
     * @var HavingCharacterComponent
     */
    private $havingCharacterComponent;

    /**
     * @var AuthComponent
     */
    private $authComponent;


    /**
     * @var HavingCharacterComponent $havingCharacterComponent
     * @var AuthComponent $authComponent
     */
    public function __construct(
        HavingCharacterComponent $havingCharacterComponent,
        AuthComponent $authComponent
    )
    {
        $this->havingCharacterComponent = $havingCharacterComponent;
        $this->authComponent = $authComponent;
    }

    public function getByGameUserID()
    {
        $gameUserID = $this->authComponent->getGameUserId();
        $havingCharacters = $this->havingCharacterComponent->getByGameUserID($gameUserID);

        return response()->protobuf(
            $havingCharacters->map(function (HavingCharacter $havingCharacter) {
                return $havingCharacter->toProtobuf();
            })->toArray()
        );
    }

}
