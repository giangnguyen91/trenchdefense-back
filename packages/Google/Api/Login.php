<?php

namespace Google\Api;

class Login
{
    /**
     * @var string
     */
    private $redirectUrl;

    /**
     * @var string
     */
    private $clientSecretPath;

    /**
     * @var array
     */
    private $scopes;

    public function __construct(
        string $redirectUrl,
        string $clientSecretPath,
        array $scopes
    )
    {
        $this->redirectUrl = $redirectUrl;
        $this->clientSecretPath = $clientSecretPath;
        $this->scopes = $scopes;
    }

    public function config()
    {
        $client = new \Google_Client();
        $client->setApplicationName("ctrlq.org Application");

        $client->setAuthConfig(base_path().'/'.$this->clientSecretPath);

        // Incremental authorization
        $client->setIncludeGrantedScopes(true);

        // Allow access to Google API when the user is not present.
        $client->setAccessType('offline');
        $client->setRedirectUri($this->redirectUrl);
        $client->setScopes($this->scopes);
        return $client;
    }

    public function authenticate(string $code)
    {
        $client = $this->config();
        $accessToken = $client->fetchAccessTokenWithAuthCode($code);

        $client->setAccessToken($accessToken['access_token']);
        return $client;
    }

    public function refreshAccessToken(string $accessToken)
    {
        $client = $this->config();
        $client->setAccessToken($accessToken);

        /* Refresh token when expired */
        if ($client->isAccessTokenExpired()) {
            // the new access token comes with a refresh token as well
            $client->fetchAccessTokenWithRefreshToken($client->getRefreshToken());
        }
        return $client;
    }

    public function getUserInfo(string $code)
    {
        $client = $this->authenticate($code);
        $oauth2 = new \Google_Service_Oauth2($client);
        $userInfo = $oauth2->userinfo->get();
        return $userInfo;
    }

}