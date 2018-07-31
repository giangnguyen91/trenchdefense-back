<?php

namespace App\Domains\Auth\Credential;

class CredentialFactory
{
    /**
    * @param AccessToken $accessToken | null
    * @param Imei $imei | null
    * @param Type $type
    * @return Credential
     */
    public function make(
        AccessToken $accessToken = null,
        Imei $imei = null,
        Type $type
    ) : Credential
    {
        return new Credential(
            $accessToken,
            $imei,
            $type
        );
    }
}