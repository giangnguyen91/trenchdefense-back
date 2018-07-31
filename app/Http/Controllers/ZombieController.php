<?php

namespace App\Http\Controllers;

use App\Components\Zombie\IZombieComponent;
use App\Domains\Zombie\Master\Zombie;

/**
 * Class ZombieController
 * @package App\Http\Controllers
 */
class ZombieController extends Controller
{
    /**
     * @var IZombieComponent
     */
    private $zombieComponent;

    /**
     * ZombieController constructor.
     * @param IZombieComponent $zombieComponent
     */
    public function __construct(IZombieComponent $zombieComponent)
    {
        $this->zombieComponent = $zombieComponent;
    }

    /**
     * @return mixed
     */
    public function getAll()
    {
        $zombies = $this->zombieComponent->getAllZombies();

        $zombies = $zombies->map(function (Zombie $zombie) {
            return $zombie->toProtobuf();
        })->toArray();

        return response()->protobuf($zombies);
    }
}
