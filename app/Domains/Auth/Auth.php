<?php

namespace App\Domains\Auth;

use App\Proto\Authenticate;
use Carbon\Carbon;

class Auth
{
    /**
     * @var string
     */
    private $accessToken;

    /**
     * @var Carbon
     */
    private $expiredAt;

    /**
     * @param AccessToken $accessToken
     * @param Carbon $expiredAt
     */

    public function __construct(
        AccessToken $accessToken,
        Carbon $expiredAt
    )
    {
        $this->accessToken = $accessToken;
        $this->expiredAt = $expiredAt;
    }

    /**
     * @return Authenticate
     */
    public function toProtobuf(): Authenticate
    {
        $model = new Authenticate();
        $model->access_token = $this->accessToken->getValue();
        $model->expired_at = $this->expiredAt->getTimestamp();
        return $model;
    }

}