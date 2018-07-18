<?php

namespace App\Components\Auth;

use App\Domains\Auth\AccessToken;
use App\Domains\Auth\Auth;
use App\Domains\Auth\Credential\Credential;
use App\Domains\User\Action\LinkSocialResult;
use App\Domains\User\UserId;

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

    /**
     * @param AccessToken $accessToken
     * @return LinkSocialResult
     */
    public function doLinkSocial(AccessToken $accessToken): LinkSocialResult;
}