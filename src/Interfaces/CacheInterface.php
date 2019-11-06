<?php

declare(strict_types=1);

namespace App\Interfaces;

use Psr\Cache\CacheItemPoolInterface;

/**
 * Interface CacheInterface
 * @package App\Util
 */
interface CacheInterface
{
    /**
     * @param CacheItemPoolInterface $cachePool
     * @param string $key
     * @param mixed $value
     * @return bool
     */
    public function saveItem(CacheItemPoolInterface $cachePool, string $key, $value): bool;

    /**
     * @param CacheItemPoolInterface $cachePool
     * @param string $key
     * @return mixed
     */
    public function getItem(CacheItemPoolInterface $cachePool, string $key);

    /**
     * @param CacheItemPoolInterface $cachePool
     * @param string $key
     * @return bool
     */
    public function deleteItem(CacheItemPoolInterface $cachePool, string $key): bool;
}