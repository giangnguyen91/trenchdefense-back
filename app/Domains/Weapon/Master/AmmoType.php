<?php
/**
 * Created by PhpStorm.
 * User: luan.tran
 * Date: 9/7/18
 * Time: 13:37
 */

namespace App\Domains\Weapon\Master;


use App\Domains\Base\Enum;

class AmmoType extends Enum
{
    const AMMO308 = "308";
    const AMMO10 = "10mm";
    const GRENADE1 = "grenade";
    const ROCKET = "rocket";
}