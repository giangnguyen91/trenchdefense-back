<?php

namespace App\Domains\User;

class UserFactory
{
    /**
     * @param ISocialID $imei | null
     * @param ISocialID $googleId | null
     * @param UserId $userId
     * @param Name $name
     * @return User|null
     */
    public function make(
        ISocialID $imei = null,
        ISocialID $googleId = null,
        UserId $userId,
        Name $name
    ): ?User
    {
        return new User(
            $imei,
            $googleId,
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
        $imei = null;
        $googleId = null;

        if(!is_null($user->google_id)){
            $googleId = new GoogleId($user->google_id);
        }
        else if(!is_null($user->imei)){
            $imei = new Imei($user->imei);
        }
        return $this->make(
            $imei,
            $googleId,
            new UserId($user->id),
            new Name($user->name)
        );
    }

    /**
     * @param ISocialID $imei
     * @param ISocialID $googleId
     * @param Name $name
     * @return User|null
     */
    public function init(
        ISocialID $imei = null,
        ISocialID $googleId = null,
        Name $name
    ): ?User
    {
        return $this->make(
            $imei,
            $googleId,
            new UserId(null),
            $name
        );
    }
}