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
        $userEloquent = User::find($gameUser->getID()->getValue());
        $newToken = $userEloquent->createToken("token-".$gameUser->getImei()->getValue());
        return $this->tokenFactory->makeByTokenResult($newToken);
    }
}