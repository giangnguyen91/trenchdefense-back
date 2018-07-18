<?php

namespace App\Components\Auth;

use App\Domains\Auth\Auth;
use App\Domains\Auth\Credential\Credential;
use App\Domains\User\UserId;
use Illuminate\Http\Request;

interface IAuthComponent
{
    /**
     * @param Credential $credential
     * @return Auth | null
     */
    public function validate(
        Credential $credential
    ): ?Auth;

    /**
     * @return UserId | null
     */
    public function getUserId(): ?UserId;
}