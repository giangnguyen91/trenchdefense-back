<?php

namespace App\Domains\Item\Master;

use App\Domains\Base\Enum;

class Type extends Enum
{
    const AMMO308 = "ammo308";
    const AMMO10 = "ammo10mm";
    const ROCKET = "rocket";
    const HP = "hp";
    const SPEED = "speed";
}