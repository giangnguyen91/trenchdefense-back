<?php
namespace App\Domains\User;

use App\Domains\Auth\Credential\Type;

interface ISocialID
{
    /**
     * @return Type
     */
    public function getLoginType(): Type;
}