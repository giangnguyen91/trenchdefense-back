<?php

namespace App\Domains\Match;

use App\Domains\Base\Enum;

class ResultType extends Enum
{
    const COMPLETE = 'complete';
    const FAILURE = 'failure';
}