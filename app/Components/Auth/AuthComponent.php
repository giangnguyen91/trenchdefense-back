<?php

namespace App\Components\Auth;

use App\Domains\User\GameUser;
use App\Domains\User\GameUserID;
use Illuminate\Auth\AuthManager;

class AuthComponent
{
    public function __construct(AuthManager $manager)
    {
        $this->guard = $manager->guard();
    }

    /**
     * @return GameUserID | null
     */
    public function getGameUserId(): ?GameUserID
    {
        if (\Config::get("debug.force_login") && \Config::get("app.env") != "production") {
            $gameUserID = new GameUserID(\Config::get("debug.user_id"));
            return $gameUserID;
        }
        if (!$this->guard->check()) {
            return null;
        }
        return new GameUserID($this->guard->id());
    }
}