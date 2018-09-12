<?php
/**
 * Created by PhpStorm.
 * User: luan.tran
 * Date: 9/11/18
 * Time: 17:58
 */

namespace App\Domains\Auth;


use App\Domains\User\GameUserID;

class Token
{
    /**
     * @var TokenID
     */
    private $tokenID;

    /**
     * @var AccessToken
     */
    private $accessToken;

    /**
     * @var GameUserID
     */
    private $gameUserID;

    public function __construct(
        TokenID $tokenID,
        AccessToken $accessToken,
        GameUserID $gameUserID
    )
    {
        $this->tokenID = $tokenID;
        $this->accessToken = $accessToken;
        $this->gameUserID = $gameUserID;
    }

    /**
     * @return AccessToken
     */
    public function getAccessToken(): AccessToken
    {
        return $this->accessToken;
    }

    /**
     * @return GameUserID
     */
    public function getGameUserID(): GameUserID
    {
        return $this->gameUserID;
    }

    public function getTokenID(): TokenID
    {
        return $this->tokenID;
    }
}