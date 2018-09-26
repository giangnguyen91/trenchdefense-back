<?php
/**
 * Created by PhpStorm.
 * User: luan.tran
 * Date: 9/11/18
 * Time: 18:15
 */

namespace App\Domains\Auth;


use App\Domains\User\GameUserID;
use Laravel\Passport\PersonalAccessTokenResult;
use Laravel\Passport\Token as TokenEloquent;

class TokenFactory
{
    public function make(
        TokenID $tokenID,
        AccessToken $accessToken,
        GameUserID $gameUserID
    ): Token
    {
        return new Token(
            $tokenID,
            $accessToken,
            $gameUserID
        );
    }

    public function makeByTokenResult(PersonalAccessTokenResult $newTokenResult): Token
    {
        $tokenID = new TokenID($newTokenResult->token->id);
        $accessToken = new AccessToken($newTokenResult->accessToken);
        $gameUserID = new GameUserID($newTokenResult->token->user->user_id);
        return new Token($tokenID, $accessToken, $gameUserID);
    }
}