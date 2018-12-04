<?php
declare(strict_types=1);

namespace App\Utils;

class CommentConstructor
{
    public function constructComment(Post $post, User $user): Comment
    {
        $comment = new Comment();
        $comment->setAuthor($this->getUser());
        $post->addComment($comment);

        return $comment;
    }
}
