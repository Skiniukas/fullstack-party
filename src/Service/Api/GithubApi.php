<?php

namespace App\Service\Api;

use Github\Client;

/**
 * Class GithubApi
 */
class GithubApi
{

    /** @var Client */
    private $client;

    /**
     * GithubApi constructor.
     * @param string $authToken
     */
    public function __construct(string $authToken)
    {
        $this->client = new Client();

        $this->client->authenticate($authToken, null, Client::AUTH_JWT);
    }

    /**
     * @return array
     */
    public function getCurrentUserRepos()
    {
        return $this->client->currentUser()->repositories();
    }
}