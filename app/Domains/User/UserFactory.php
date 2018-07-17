<?php

namespace App\Domains\User;

class UserFactory
{
    /**
     * @param ISocialID $socialID | null
     * @param UserId $userId
     * @return User|null
     */
    public function make(
        ISocialID $socialID = null,
        UserId $userId,
        Name $name
    ): ?User
    {
        return new User(
            $socialID,
            $userId,
            $name
        );

    }

    /**
     * @param \App\User $user
     * @return User|null
     */
    public function makeByEloquent(
        \App\User $user
    ): ?User
    {
        $socialId = null;

        if(!is_null($user->google_id)){
            $socialId = new GoogleId($user->google_id);
        }
        else if(!is_null($user->imei)){
            $socialId = new Imei($user->imei);
        }
        return $this->make(
            $socialId,
            new UserId($user->id),
            new Name($user->name)
        );
    }

    /**
     * @param ISocialID $socialId
     * @return User|null
     */
    public function init(
        Name $name,
        ISocialID $socialId
    ): ?User
    {
        return $this->make(
            $socialId,
            new UserId(null),
            $name
        );
    }
}