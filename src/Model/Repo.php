<?php

namespace App\Model;

/**
 * Class Repo
 */
class Repo
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $fullName;

    /**
     * @var string
     */
    private $ownerName;

    /**
     * @var string
     */
    private $ownerUrl;

    /**
     * @var string
     */
    private $url;

    /**
     * @var string
     */
    private $description;

    /**
     * @var \DateTime
     */
    private $createdAt;

    /**
     * @var \DateTime
     */
    private $updatedAt;

    /**
     * @var \DateTime
     */
    private $pushedAt;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Repo
     */
    public function setId($id): Repo
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Repo
     */
    public function setName($name): Repo
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getFullName(): string
    {
        return $this->fullName;
    }

    /**
     * @param string $fullName
     * @return Repo
     */
    public function setFullName($fullName): Repo
    {
        $this->fullName = $fullName;

        return $this;
    }

    /**
     * @return string
     */
    public function getOwnerName(): string
    {
        return $this->ownerName;
    }

    /**
     * @param string $ownerName
     * @return Repo
     */
    public function setOwnerName($ownerName): Repo
    {
        $this->ownerName = $ownerName;

        return $this;
    }

    /**
     * @return string
     */
    public function getOwnerUrl(): string
    {
        return $this->ownerUrl;
    }

    /**
     * @param string $ownerUrl
     * @return Repo
     */
    public function setOwnerUrl($ownerUrl): Repo
    {
        $this->ownerUrl = $ownerUrl;

        return $this;
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @param string $url
     * @return Repo
     */
    public function setUrl($url): Repo
    {
        $this->url = $url;

        return $this;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return Repo
     */
    public function setDescription($description): Repo
    {
        $this->description = $description;

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
     * @return Repo
     */
    public function setCreatedAt(\DateTime $date = null)
    {
        $this->createdAt = $date;

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
     * @return Repo
     */
    public function setUpdatedAt(\DateTime $date = null)
    {
        $this->updatedAt = $date;

        return $this;
    }

    /**
     * Get pushed date
     *
     * @return \DateTime
     */
    public function getPushedAt()
    {
        return $this->pushedAt;
    }

    /**
     * @param \DateTime $date
     * @return Repo
     */
    public function setPushedAt(\DateTime $date = null)
    {
        $this->pushedAt = $date;

        return $this;
    }
}