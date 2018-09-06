<?php

namespace App\Components\Auth;

use App\Domains\User\GameUserID;

class AuthComponent
{
    /**
     * @return GameUserID | null
     */
    public function getGameUserId()
    {
        if (\Config::get("debug.force_login") && \Config::get("app.env") != "production") {
            $gameUserID = new GameUserID(\Config::get("debug.user_id"));
            return $gameUserID;
        }
        return null;
    }
}