<?php

namespace App\Http\Controllers\Admin;

use App\Components\Character\CharacterComponent;
use App\Components\Character\HavingCharacterComponent;
use App\Domains\Character\CharacterID;
use App\Domains\Character\Having\HavingCharacterFactory;
use App\Domains\User\GameUserID;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class HavingCharacterController extends Controller
{

    /**
     * @var HavingCharacterComponent
     */
    private $havingCharacterComponent;

    /**
     * @var HavingCharacterFactory
     */
    private $havingCharacterFactory;

    /**
     * @var CharacterComponent
     */
    private $characterComponent;

    /**
     * @param HavingCharacterComponent $havingCharacterComponent
     * @param HavingCharacterFactory $havingCharacterFactory
     * @param CharacterComponent $characterComponent
     */
    public function __construct(
        HavingCharacterComponent $havingCharacterComponent,
        HavingCharacterFactory $havingCharacterFactory,
        CharacterComponent $characterComponent
    )
    {
        $this->havingCharacterComponent = $havingCharacterComponent;
        $this->havingCharacterFactory = $havingCharacterFactory;
        $this->characterComponent = $characterComponent;
    }

    public function index(Request $request)
    {
        $gameUserID = $request->input('game_user_id', null);

        if ($gameUserID) {
            $characters = $this->havingCharacterComponent->getByGameUserID(new GameUserID($gameUserID));
        }
        return view('admin.having_character.list', compact('characters', 'gameUserID'));
    }

    public function addNew(Request $request)
    {
        $gameUserID = $request->input('game_user_id', null);
        $characterID = $request->input('character_id', null);

        $character = $this->characterComponent->get(new CharacterID($characterID));

        if ($character) {
            $this->havingCharacterComponent->addNew(new GameUserID($gameUserID), $character->getId());
        }
        return redirect()->route('admin.having_character.list', ['game_user_id' => $gameUserID]);
    }

}
