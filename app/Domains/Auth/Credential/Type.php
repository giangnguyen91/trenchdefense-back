<?php
namespace App\Domains\Auth\Credential;

use App\Domains\Base\Enum;

class Type extends Enum
{
    const GOOGLE = 1;
    const FACEBOOK = 2;
    const GUEST = 3;
}