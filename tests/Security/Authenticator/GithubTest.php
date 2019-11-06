<?php

namespace Tests\Security\Authenticator;

use PHPUnit\Framework\TestCase;
use League\OAuth2\Client\Provider\Github;

class GithubTest extends TestCase
{
    protected $provider;

    protected function setUp()
    {
        $this->provider = new Github([
            'clientId' => 'client_id',
            'clientSecret' => 'client_secret',
            'redirectUri' => 'http://localhost',
        ]);
    }

    public function testAuthorizationUrl()
    {
        $url = $this->provider->getAuthorizationUrl();
        $uri = parse_url($url);

        $this->assertEquals($uri['scheme'], 'https');
        $this->assertEquals($uri['host'], 'github.com');
        $this->assertEquals($uri['path'], '/login/oauth/authorize');
        $this->assertNotNull($uri['query']);
    }

    public function testAuthorizationData()
    {
        $url = $this->provider->getAuthorizationUrl();
        $uri = parse_url($url);
        parse_str($uri['query'], $query);

        $this->assertEquals($query['client_id'], 'client_id');
        $this->assertNotNull($query['state']);
        $this->assertEquals($query['redirect_uri'], 'http://localhost');
    }

}
