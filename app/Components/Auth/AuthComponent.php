<?php

namespace App\Components\Auth;

use App\Domains\User\GameUserID;

class AuthComponent
{
    /**
     * @return GameUserID | null
     */
    public function getGameUserId(): ?GameUserID
    {
        $user = request()->user();
        if (is_null($user)) {
            return null;
        }
        return new GameUserID($user->id);
    }
}