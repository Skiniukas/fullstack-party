<?php


namespace Tests\Security\Authenticator;

use App\Model\Repo;
use App\Model\RepoList;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class RepoTest extends WebTestCase
{

    private $date;

    private $repo;

    public function setUp()
    {
        $this->date = new \DateTime();
        $this->date->setTimestamp(1572952559);

        $this->repo = new Repo();
        $this->repo->setId('1');
        $this->repo->setName('Name');
        $this->repo->setFullName('Full name');
        $this->repo->setOwnerName('Owner name');
        $this->repo->setUrl('http://');
        $this->repo->setOwnerUrl('http://');
        $this->repo->setCreatedAt($this->date);
        $this->repo->setUpdatedAt($this->date);
        $this->repo->setPushedAt($this->date);
    }

    public function testRepo()
    {
        $this->assertEquals("1", $this->repo->getId());
        $this->assertEquals("Name", $this->repo->getName());
        $this->assertEquals("Full name", $this->repo->getFullName());
        $this->assertEquals("Owner name", $this->repo->getOwnerName());
        $this->assertEquals("http://", $this->repo->getUrl());
        $this->assertEquals("http://", $this->repo->getOwnerUrl());
        $this->assertEquals(null, $this->repo->getDescription());
        $this->assertEquals($this->date->getTimestamp(), $this->repo->getCreatedAt()->getTimestamp());
        $this->assertEquals($this->date->getTimestamp(), $this->repo->getUpdatedAt()->getTimestamp());
        $this->assertEquals($this->date->getTimestamp(), $this->repo->getPushedAt()->getTimestamp());
    }

    public function testRepoList()
    {
        $repoList = new RepoList();
        $repoList->add($this->repo);

        $this->assertEquals(1, $repoList->getCount());
        $this->assertEquals($this->repo, $repoList->get(1));

    }
}