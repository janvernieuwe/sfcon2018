<?php
declare(strict_types=1);

namespace App\Repository;

use App\Entity\Post;

interface PostRepositoryInterface
{
    public function getOneBySlug(string $slug): ?Post;
}
