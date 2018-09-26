<?php
/**
 * Created by PhpStorm.
 * User: luan.tran
 * Date: 9/11/18
 * Time: 18:03
 */

namespace App\Domains\Auth;

use App\Domains\User\GameUser;
use App\User;
use Carbon\Carbon;
use Laravel\Passport\Token as TokenEloquent;

class TokenRepository
{
    private $tokenFactory;

    public function __construct(TokenFactory $tokenFactory)
    {
        $this->tokenFactory = $tokenFactory;
    }

    public function createTokenForGameUser(GameUser $gameUser): ?Token
    {
        $token = TokenEloquent::query()
            ->where("user_id", "=", $gameUser->getID()->getValue())
            ->where("revoked", "=", false)
            ->where("expires_at", ">", Carbon::now())
            ->first();

        return $this->createToken($gameUser);
    }

    /**
     * Create new personal access token for game user
     * @param GameUser $gameUser
     * @return Token
     */
    private function createToken(GameUser $gameUser): Token
    {
        $userEloquent = User::find($gameUser->getID()->getValue());
        $newToken = $userEloquent->createToken("token-".$gameUser->getImei()->getValue());
        return $this->tokenFactory->makeByTokenResult($newToken);
    }
}