<?php

namespace App\Components\Auth;

use App\Components\User\IUserComponent;
use App\Domains\Auth\AccessToken;
use App\Domains\Auth\Auth;
use App\Domains\Auth\AuthRepository;
use App\Domains\Auth\Credential\Credential;
use App\Domains\Auth\Credential\Type;
use App\Domains\User\GoogleId;
use App\Domains\User\Imei;
use App\Domains\User\Name;
use App\Domains\User\User;
use App\Domains\User\UserId;
use Google\Api\Login;
use Illuminate\Auth\AuthManager;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use Laravel\Passport\PersonalAccessTokenResult;

class AuthComponent implements IAuthComponent
{
    /**
     * @var IUserComponent;
     */
    private $userComponent;

    /**
     * @var AuthRepository;
     */
    private $authRepository;

    /**
     * @var \Illuminate\Contracts\Auth\Guard|\Illuminate\Contracts\Auth\StatefulGuard
     */
    private $guard;

    /**
     * @param IUserComponent $userComponent
     * @param AuthRepository $authRepository
     * @param AuthManager $authManager
     * @param Guard $guard
     */
    public function __construct(
        IUserComponent $userComponent,
        AuthRepository $authRepository,
        AuthManager $authManager,
        Guard $guard
    )
    {
        $this->userComponent = $userComponent;
        $this->authRepository = $authRepository;
        $this->guard = $authManager->guard();
    }


    /**
     * @param Credential $credential
     * @return Auth | null
     */
    public function validate(
        Credential $credential
    ): ?Auth
    {
        $loginType = $credential->getType()->getValue();

        $imeiId = null;
        $googleId = null;
        if ($loginType == Type::GOOGLE) {
            $user = $this->authenticateGoogle($credential->getAccessToken()->getValue());
            $googleId = new GoogleId($user->id);
            $name = new Name($user->name);
        } else {
            $name = new Name('guest_'.rand(1,9999));
            $imeiId = new Imei($credential->getImei()->getValue());

        }
        $user = $this->userComponent->getUserBySocialId($imeiId, $googleId);

        if (is_null($user)) {
            $userId = $this->userComponent->createUser($imeiId, $googleId, $name);
        } else {
            $userId = $user->getUserId();
        }

        $authInfo = $this->generateToken($userId);
        $auth = new Auth(new AccessToken($authInfo->accessToken), $authInfo->token->expires_at);
        return $auth;
    }

    /**
     * @param UserId $userId
     * @return PersonalAccessTokenResult
     */
    public function generateToken(
        UserId $userId
    ): PersonalAccessTokenResult
    {
        return $this->authRepository->generateToken($userId);
    }

    /**
     * @param string $accessToken
     * @return \Google_Service_Oauth2_Userinfoplus
     */
    private function authenticateGoogle(string $accessToken): \Google_Service_Oauth2_Userinfoplus
    {
        $googlePackage = new Login(
            env('APP_URL'),
            config('google.client_secret'),
            config('google.scope')
        );

        $user = $googlePackage->getUserInfo($accessToken);
        return $user;
    }

    /**
     * @return UserId | null
     */
    public function getUserId(): ?UserId
    {
        $request = app(Request::class);
        if (!$request->user()) {
            return null;
        }
        return new UserId($request->user()->id);
    }
}