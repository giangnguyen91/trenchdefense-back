<?php

namespace App\Domains\Wave\Progress;

use App\Domains\Base\ValueObject\IntValueObject;

class Status extends IntValueObject
{
    const CLEAR = 1;
    const PAUSE = 2;
    const FAILED = 3;
}