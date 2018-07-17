<?php

namespace App\Domains\Auth;
use Carbon\Carbon;

class AuthFactory
{
    /**
     * @param AccessToken $accessToken
     * @param Carbon $expiredAt
     * @return Auth
     */

    public function make(
        AccessToken $accessToken,
        Carbon $expiredAt
    ) : Auth
    {
        return new Auth(
            $accessToken,
            $expiredAt
        );
    }

}