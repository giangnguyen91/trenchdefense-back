<?php
namespace App\Components\User;
use App\Domains\User\ISocialID;
use App\Domains\User\Name;
use App\Domains\User\User;
use App\Domains\User\UserId;

interface IUserComponent
{
    public function getUserBySocialId(
        ISocialID $socialID
    ) : ?User;

    public function createUser(
        ISocialID $socialID,
        Name $name
    ): UserId;
}