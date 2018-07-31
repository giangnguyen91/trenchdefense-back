<?php

namespace App\Domains\Auth\Credential;

class Credential
{
    /**
     * @var AccessToken
     */
    private $accessToken;

    /**
     * @var Imei
     */
    private $imei;

    /**
     * @var Type
     */
    private $type;

    /**
     * @param AccessToken $accessToken | null
     * @param Imei $imei | null
     * @param Type $type
     */
    public function __construct(
        AccessToken $accessToken = null,
        Imei $imei = null,
        Type $type
    )
    {
        $this->accessToken = $accessToken;
        $this->imei = $imei;
        $this->type = $type;
    }

    /**
     * @return AccessToken|null
     */
    public function getAccessToken(): ?AccessToken
    {
        return $this->accessToken;
    }

    /**
     * @return Imei|null
     */
    public function getImei(): ?Imei
    {
        return $this->imei;
    }

    /**
     * @return Type
     */
    public function getType(): Type
    {
        return $this->type;
    }
}