<?php

namespace Tests\Security\Authenticator;

use App\Service\Api\GithubApi;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class GithubApiTest extends WebTestCase
{
    public function testCurrentUserRepos()
    {
        self::bootKernel();

        $this->assertIsArray(self::$container->get('GithubApi')->getCurrentUserRepos());
    }

    public function testCurrentUserReposMock()
    {
        self::bootKernel();

        $returnData = ['1', '2'];

        $service = $this->getMockBuilder(GithubApi::class)
            ->disableOriginalConstructor()
            ->setMethods(['getCurrentUserRepos'])
            ->getMock();

        $service->expects($this->any())
            ->method('getCurrentUserRepos')
            ->will($this->returnValue($returnData));

        $this->assertEquals($returnData, $service->getCurrentUserRepos());
    }
}