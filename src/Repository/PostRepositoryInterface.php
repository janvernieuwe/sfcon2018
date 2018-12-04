<?php
declare(strict_types=1);

namespace App\Repository;

interface PostRepositoryInterface
{
    public function getOneBySlug(string $slug): ?Post;
}
