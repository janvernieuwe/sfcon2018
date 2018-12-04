<?php
declare(strict_types=1);

namespace App\Repository;

use Psr\Cache\CacheItemPoolInterface;

class RedisPostRepository implements PostRepositoryInterface
{
    /**
     * @var CacheItemPoolInterface
     */
    private $cache;

    public function __construct(CacheItemPoolInterface $cache)
    {
        $this->cache = $cache;
    }

    public function getOneBySlug(string $slug): ?Post
    {
        if ($this->cache->hasItem('post.' . $slug)) {
            return $this->cache->getItem('post.' . $slug)->get();
        }

        return null;
    }
}
