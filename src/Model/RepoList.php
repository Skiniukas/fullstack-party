<?php

namespace App\Model;

/**
 * Class RepoList
 */
class RepoList
{
    /**
     * @var array
     */
    private $list;

    /**
     * @param Repo $repo
     */
    public function add(Repo $repo)
    {
        $this->list[$repo->getId()] = $repo;
    }

    /**
     * @param $id
     * @return mixed|null
     */
    public function get($id)
    {
        if (isset($this->list[$id])) {
            return $this->list[$id];
        }

        return null;
    }

    /**
     * @return array
     */
    public function list()
    {
        return $this->list;
    }

    /**
     * @return int
     */
    public function getCount()
    {
        return count($this->list);
    }
}