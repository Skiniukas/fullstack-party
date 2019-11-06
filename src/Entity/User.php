<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @ORM\Table(name="user")
 */
final class User implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", unique=true)
     */
    private $githubUserId;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $githubAccessToken;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     */
    private $githubUsername;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $githubNickname;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $githubAvatar;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updatedAt;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    public function __construct(int $githubUserId)
    {
        $this->githubUserId = $githubUserId;
        if (null == $this->createdAt) {
            $this->createdAt = new \Datetime();
        }
    }

    /**
     * Get Id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * get Github User Id
     *
     * @return string
     */
    public function getGithubUserId()
    {
        return $this->githubUserId;
    }

    /**
     * set Github User Id
     *
     * @param string $githubUserId
     * @return User
     */
    public function setGithubUserId($githubUserId)
    {
        $this->githubUserId = $githubUserId;

        return $this;
    }

    /**
     * get Github Access Token
     *
     * @return string
     */
    public function getGithubAccessToken()
    {
        return $this->githubAccessToken;
    }

    /**
     * set Github Access Token
     *
     * @param string $githubAccessToken
     * @return User
     */
    public function setGithubAccessToken($githubAccessToken)
    {
        $this->githubAccessToken = $githubAccessToken;

        return $this;
    }

    /**
     * get Github Username
     *
     * @return string
     */
    public function getGithubUsername()
    {
        return $this->githubUsername;
    }

    /**
     * set Github Username
     *
     * @param string $githubUsername
     * @return User
     */
    public function setGithubUsername($githubUsername)
    {
        $this->githubUsername = $githubUsername;

        return $this;
    }

    /**
     * get Github Nickname
     *
     * @return string
     */
    public function getGithubNickname()
    {
        return $this->githubNickname;
    }

    /**
     * set Github Nickname
     *
     * @param string $githubNickname
     * @return User
     */
    public function setGithubNickname($githubNickname)
    {
        $this->githubNickname = $githubNickname;

        return $this;
    }

    /**
     * get Github Avatar
     *
     * @return string
     */
    public function getGithubAvatar()
    {
        return $this->githubAvatar;
    }

    /**
     * set Github Avatar
     *
     * @param string $githubAvatar
     * @return User
     */
    public function setGithubAvatar($githubAvatar)
    {
        $this->githubAvatar = $githubAvatar;

        return $this;
    }

    /**
     * Get updated date
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @param \DateTime $date
     *
     * @return User
     */
    public function setUpdatedAt(\DateTime $date = null)
    {
        $this->updatedAt = $date;

        return $this;
    }

    /**
     * Get created date
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTime $date
     *
     * @return User
     */
    public function setCreatedAt(\DateTime $date = null)
    {
        $this->createdAt = $date;

        return $this;
    }

    /**
     * @return string[]
     */
    public function getRoles(): array
    {
        return ['ROLE_USER'];
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return '';
    }

    /**
     * @return string|null
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->githubUsername;
    }

    public function eraseCredentials(): void
    {
    }
}