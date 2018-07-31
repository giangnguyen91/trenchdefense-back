<?php

namespace App\Domains\User;

use Illuminate\Contracts\Auth\Authenticatable;

class User
{
    /**
     * @var  UserId
     */
    private $userId;

    /**
     * @var ISocialID
     */
    private $imei;

    /**
     * @var ISocialID
     */
    private $googleId;

    /**
     * @var Name
     */
    private $name;

    /**
     * @param ISocialID $imei | null
     * @param ISocialID $googleId | null
     * @param UserId $userId
     * @param Name $name
     */
    public function __construct(
        ISocialID $imei = null,
        ISocialID $googleId = null,
        UserId $userId,
        Name $name
    )
    {
        $this->imei = $imei;
        $this->googleId = $googleId;
        $this->userId = $userId;
        $this->name = $name;
    }

    /**
     * @return ISocialID | null
     */
    public function getImei(): ?ISocialID
    {
        return $this->imei;
    }

    /**
     * @return ISocialID | null
     */
    public function getGoogleId(): ?ISocialID
    {
        return $this->googleId;
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
     * @param GoogleId $googleId
     * @return User
     */
    public function setGoogleId(GoogleId $googleId): User
    {
        $this->googleId = $googleId;
        return $this;
    }

    /**
     * @param Name $name
     * @return User
     */
    public function setName(Name $name): User
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return \App\Proto\User()
     */
    public function toProtobuf()
    {
        $proto = new \App\Proto\User();
        $proto->name = $this->name->getValue();
        $proto->imei = !is_null($this->getImei()) ? $this->getImei()->getValue() : null;
        $proto->google_id = !is_null($this->getGoogleId()) ? $this->getGoogleId()->getValue() : null;

        return $proto;
    }
}