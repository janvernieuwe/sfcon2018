<?php
declare(strict_types=1);

namespace App\Repository;

use App\Entity\Post;

class ChainPostRepository implements PostRepositoryInterface
{
    /**
     * @var PostRepositoryInterface[]
     */
    private $repositories;

    public function add(PostRepositoryInterface $postRepository)
    {
        $this->repositories[] = $postRepository;
    }

    public function getOneBySlug(string $slug): ?Post
    {
        foreach ($this->repositories as $repository) {
            if ($post = $repository->getBySlug($slug)) {
                return $post;
            }
        }

        return null;
    }
}
