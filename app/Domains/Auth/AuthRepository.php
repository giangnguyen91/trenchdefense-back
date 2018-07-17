<?php

namespace App\Domains\Auth;

use App\Domains\User\UserId;
use App\User;
use Laravel\Passport\PersonalAccessTokenResult;

class AuthRepository
{

    /**
     * @var AuthFactory
     */
    private $authFactory;

    /**
     * @param AuthFactory $authFactory
     */
    public function __construct(
        AuthFactory $authFactory
    )
    {
        $this->authFactory = $authFactory;
    }

    /**
     * @param UserId $userId
     * @return PersonalAccessTokenResult | null
     */
    public function generateToken(
        UserId $userId
    ): ?PersonalAccessTokenResult
    {
        $userEloquent = \App\User::query()->find($userId->getValue())->first();
        if (is_null($userEloquent)) return null;
        return $userEloquent->createToken('Zoombie');
    }
}