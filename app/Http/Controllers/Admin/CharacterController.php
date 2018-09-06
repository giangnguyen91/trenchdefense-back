<?php

namespace App\Http\Controllers\Admin;

use App\Components\Character\CharacterComponent;
use App\Domains\Character\CharacterFactory;
use App\Domains\Character\CharacterID;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class CharacterController extends Controller
{

    /**
     * @var CharacterComponent
     */
    private $characterComponent;

    /**
     * @var CharacterFactory
     */
    private $characterFactory;

    /**
     * @param CharacterComponent $characterComponent
     * @param CharacterFactory $characterFactory
     */
    public function __construct(
        CharacterComponent $characterComponent,
        CharacterFactory $characterFactory
    )
    {
        $this->characterComponent = $characterComponent;
        $this->characterFactory = $characterFactory;
    }

    public function index()
    {
        $characters = $this->characterComponent->getAll();
        return view('admin.character.list', compact('characters'));
    }

    public function getCreate()
    {
        $mode = 'create';
        return view('admin.character.form', compact('mode'));
    }

    public function postCreate(Request $request)
    {
        $params = $request->input();
        $data = $this->characterFactory->makeByArray($params);
        $this->characterComponent->addNew($data);

        return redirect()->route('admin.character.list');
    }

    public function getUpdate(int $characterID)
    {
        $zombie = $this->characterComponent->get(new CharacterID($characterID));

        if (is_null($zombie)) throw new \Exception('Not Found');

        $default = $zombie->toArray();
        $mode = 'update';
        return view('admin.character.form', compact('default', 'mode'));
    }

    public function postUpdate(Request $request, int $zombieID)
    {
        $params = $request->input();
        $params['id'] = $zombieID;

        $data = $this->characterFactory->makeByArray($params);
        $this->characterComponent->addNew($data);

        return redirect()->route('admin.character.list');
    }


    public function delete(int $characterID)
    {
        $character = $this->characterComponent->get(new CharacterID($characterID));

        if (is_null($character)) throw new \Exception('Not Found');

        $this->characterComponent->remove($character);
        return redirect()->route('admin.character.list');
    }

}
