<?php

namespace App\Components\User;

use App\Domains\User\ISocialID;
use App\Domains\User\Name;
use App\Domains\User\User;
use App\Domains\User\UserId;

interface IUserComponent
{
    /**
     * @param ISocialID $imeiId | null
     * @param ISocialID $googleId | null
     * @return User | null
     */
    public function getUserBySocialId(
        ISocialID $imeiId = null,
        ISocialID $googleId = null
    ): ?User;

    /**
     * @param ISocialID $imeiId | null
     * @param ISocialID $googleId | null
     * @param Name $name
     * @return UserId
     */
    public function createUser(
        ISocialID $imeiId = null,
        ISocialID $googleId = null,
        Name $name
    ): UserId;

    /**
     * @param UserId $userId
     * @return User
     */
    public function getUser(
        UserId $userId
    ): User;

    /**
     * @param User $user
     * @return UserId
     */
    public function persist(
        User $user
    ): UserId;

    /**
     * @param UserId $userId
     * @param Name $name
     * @return User
     */
    public function updateName(
        UserId $userId,
        Name $name
    ): User;
}