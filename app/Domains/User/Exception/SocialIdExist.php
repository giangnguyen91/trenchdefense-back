<?php

namespace App\Domains\User\Exception;

use App\Exceptions\Error;

class SocialIdExist extends Error
{
    public function __construct()
    {
        parent::__construct(
            'Your social ID already linked to another account',
            4030,
            200
        );
    }

}