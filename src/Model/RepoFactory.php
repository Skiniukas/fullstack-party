<?php

namespace App\Model;

use App\Model\Repo;

/**
 * Class RepoFactory
 */
final class RepoFactory
{
    /**
     * @param array $repoData
     * @return RepoList
     * @throws \Exception
     */
    public static function createList(array $repoData): RepoList
    {
        $repoList = new RepoList();

        foreach ($repoData as $data) {
            $repoList->add((new Repo())
                ->setId($data['id'])
                ->setName($data['name'])
                ->setFullName($data['full_name'])
                ->setUrl($data['html_url'])
                ->setDescription($data['description'])
                ->setOwnerName($data['owner']['login'])
                ->setOwnerUrl($data['owner']['html_url'])
                ->setCreatedAt(new \DateTime($data['created_at']))
                ->setUpdatedAt(new \DateTime($data['updated_at']))
                ->setPushedAt(new \DateTime($data['pushed_at']))
            );
        }

        return $repoList;
    }
}