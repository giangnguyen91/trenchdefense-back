<?php

namespace App\Http\Controllers\Admin;

use App\Components\Zombie\ZombieComponent;
use App\Domains\Zombie\ZombieFactory;
use App\Domains\Zombie\ZombieID;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class ZombieController extends Controller
{

    /**
     * @var ZombieComponent
     */
    private $zombieComponent;

    /**
     * @var ZombieFactory
     */
    private $zombieFactory;

    /**
     * @param ZombieComponent $zombieComponent
     * @param ZombieFactory $zombieFactory
     */
    public function __construct(
        ZombieComponent $zombieComponent,
        ZombieFactory $zombieFactory
    )
    {
        $this->zombieComponent = $zombieComponent;
        $this->zombieFactory = $zombieFactory;
    }

    public function index()
    {
        $zombies = $this->zombieComponent->getAllZombie();
        return view('admin.zombie.list', compact('zombies'));
    }

    public function getCreate()
    {
        $mode = 'create';
        return view('admin.zombie.form', compact('mode'));
    }

    public function postCreate(Request $request)
    {
        $params = $request->input();
        $data = $this->zombieFactory->makeByArray($params);
        $this->zombieComponent->addNewZombie($data);

        return redirect()->route('admin.zombie.list');
    }

    public function getUpdate(int $zombieID)
    {
        $zombie = $this->zombieComponent->get(new ZombieID($zombieID));

        if (is_null($zombie)) throw new \Exception('Not Found');

        $default = $zombie->toArray();
        $mode = 'update';
        return view('admin.zombie.form', compact('default', 'mode'));
    }

    public function postUpdate(Request $request, int $zombieID)
    {
        $params = $request->input();
        $params['id'] = $zombieID;

        $data = $this->zombieFactory->makeByArray($params);
        $this->zombieComponent->addNewZombie($data);

        return redirect()->route('admin.zombie.list');
    }


    public function delete(int $zombieID)
    {
        $zombie = $this->zombieComponent->get(new ZombieID($zombieID));

        if (is_null($zombie)) throw new \Exception('Not Found');

        $this->zombieComponent->remove($zombie);
        return redirect()->route('admin.zombie.list');
    }

}
