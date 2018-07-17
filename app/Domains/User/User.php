<?php

namespace App\Domains\User;

use Illuminate\Contracts\Auth\Authenticatable;

class User implements Authenticatable
{
    /**
     * @var  UserId
     */
    private $userId;

    /**
     * @var ISocialID
     */
    private $socialId;

    /**
     * @var Name
     */
    private $name;

    /**
     * @param ISocialID $socialId
     * @param UserId $userId
     */
    public function __construct(
        ISocialID $socialId,
        UserId $userId,
        Name $name
    )
    {
        $this->socialId = $socialId;
        $this->userId = $userId;
        $this->name = $name;
    }

    /**
     * @return ISocialID
     */
    public function getSocialId(): ISocialID
    {
        return $this->socialId;
    }

    /**
     * @return Name
     */
    public function getName(): Name
    {
        return $this->name;
    }

    /**
     * @return UserId
     */
    public function getUserId(): UserId
    {
        return $this->userId;
    }

    /**
     * Get the name of the unique identifier for the user.
     *
     * @return string
     */
    public function getAuthIdentifierName()
    {
        return 'id';
    }

    public function getAuthIdentifier()
    {
        return $this->userId->getValue();
    }

    public function getAuthPassword()
    {
        return '';
    }

    /**
     * Get the token value for the "remember me" session.
     *
     * @return string
     */
    public function getRememberToken()
    {
        return '';
    }

    /**
     * Set the token value for the "remember me" session.
     *
     * @param  string $value
     * @return void
     */
    public function setRememberToken($value)
    {
    }

    /**
     * Get the column name for the "remember me" token.
     *
     * @return string
     */
    public function getRememberTokenName()
    {
        return '';
    }
}