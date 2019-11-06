<?php

namespace App\Cache;

use App\Service\Api\GithubApi;
use App\Util\RedisUtil;
use Doctrine\ORM\Cache\CacheException;
use Psr\Cache\CacheItemPoolInterface;

/**
 * Class GithubReposCache
 * @package App\Cache
 */
class GithubReposCache
{
    CONST CURRENT_USER_REPOS_KEY = 'current_user_repos';
    CONST CACHE_EXPIRE = 60;

    /**
     * @var GithubApi
     */
    private $githubApi;

    /**
     * @var RedisUtil
     */
    private $redisUtil;

    /**
     * @var CacheItemPoolInterface
     */
    private $reposPool;

    /**
     * GithubApiReposCache constructor.
     * @param GithubApi $githubApi
     * @param RedisUtil $redisUtil
     * @param CacheItemPoolInterface $reposPool
     */
    public function __construct(GithubApi $githubApi, RedisUtil $redisUtil, CacheItemPoolInterface $reposPool)
    {
        $this->githubApi = $githubApi;
        $this->redisUtil = $redisUtil;
        $this->reposPool = $reposPool;
    }

    /**
     * @return array|mixed|null
     * @throws CacheException
     */
    public function getCurrentUserRepos()
    {
        $repos = $this->redisUtil->getItem($this->reposPool, self::CURRENT_USER_REPOS_KEY);
        if (null == $repos) {
            $repos = $this->githubApi->getCurrentUserRepos();

            $this->redisUtil->saveItem(
                $this->reposPool,
                self::CURRENT_USER_REPOS_KEY,
                $repos,
                self::CACHE_EXPIRE
            );
        }

        return $repos;
    }
}