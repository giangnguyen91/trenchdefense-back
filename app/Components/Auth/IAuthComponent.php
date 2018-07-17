<?php
namespace App\Components\Auth;

use App\Domains\Auth\Auth;
use App\Domains\Auth\Credential\Credential;

interface IAuthComponent
{
    public function validate(
        Credential $credential
    ) : ?Auth;
}