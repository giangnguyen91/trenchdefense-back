<?php

namespace App\Http\Controllers;

use App\Components\Weapon\IWeaponComponent;
use App\Domains\Weapon\Master\Weapon;
use Illuminate\Http\Request;

class WaveController extends Controller
{
    /**
     * @var IWeaponComponent
     */
    private $weaponComponent;

    /**
     * @var IWeaponComponent $weaponComponent
     */
    public function __construct(
        IWeaponComponent $weaponComponent
    )
    {
        $this->weaponComponent = $weaponComponent;
    }

    public function getAll()
    {
        $weapons = $this->weaponComponent->getAllWeapon();

        $weapons = $weapons->map(function (Weapon $weapon) {
            return $weapon->toProtobuf();
        })->toArray();

        return response()->protobuf($weapons);
    }

}
