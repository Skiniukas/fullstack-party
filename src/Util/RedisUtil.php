<?php

declare(strict_types=1);

namespace App\Util;

use Doctrine\ORM\Cache\CacheException;
use Psr\Cache\CacheItemInterface;
use Psr\Cache\InvalidArgumentException;
use Psr\Cache\CacheItemPoolInterface;
use App\Interfaces\CacheInterface;

/**
 * Class RedisUtil
 * @package App\Util
 */
class RedisUtil implements CacheInterface
{
    /**
     * @param CacheItemPoolInterface $cachePool
     * @param string $key
     * @param mixed $value
     * @param int|null $expire
     * @return bool
     * @throws CacheException
     */
    public function saveItem(CacheItemPoolInterface $cachePool, string $key, $value, $expire = null): bool
    {
        $item = $this->fetch($cachePool, $key);
        if (null != $expire) {
            $item->expiresAfter($expire);
        }
        $item->set($value);

        return $cachePool->save($item);
    }

    /**
     * @param CacheItemPoolInterface $cachePool
     * @param string $key
     * @return mixed|null
     * @throws CacheException
     */
    public function getItem(CacheItemPoolInterface $cachePool, string $key)
    {
        $result = null;

        $item = $this->fetch($cachePool, $key);
        if ($item->isHit()) {
            $result = $item->get();
        }

        return $result;
    }

    /**
     * @param CacheItemPoolInterface $cachePool
     * @param string $key
     * @return bool
     * @throws CacheException
     * @throws InvalidArgumentException
     */
    public function deleteItem(CacheItemPoolInterface $cachePool, string $key): bool
    {
        try {
            $cachePool->deleteItem($key);
        } catch (\InvalidArgumentException $e) {
            throw new CacheException($e->getMessage());
        }
    }

    /**
     * @param CacheItemPoolInterface $cachePool
     * @param string $key
     * @return CacheItemInterface
     * @throws CacheException
     */
    private function fetch(CacheItemPoolInterface $cachePool, string $key): CacheItemInterface
    {
        try {
            return $cachePool->getItem($key);
        } catch (InvalidArgumentException $e) {
            throw new CacheException($e->getMessage());
        }
    }
}