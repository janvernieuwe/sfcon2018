<?php
declare(strict_types=1);

namespace App\Utils;

use App\Entity\Comment;
use Doctrine\Common\Persistence\ManagerRegistry;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class CommentService
{
    /**
     * @var ManagerRegistry
     */
    private $registry;

    /**
     * @var EventDispatcherInterface
     */
    private $eventDispatcher;

    public function __construct(ManagerRegistry $registry, EventDispatcherInterface $eventDispatcher)
    {
        $this->registry        = $registry;
        $this->eventDispatcher = $eventDispatcher;
    }

    public function saveComment(Comment $comment): void
    {
        $this->persistComment($comment);

        $this->dispatchCommentEvent($comment);
    }

    private function persistComment(Comment $comment): void
    {
        $em = $this->registry->getManager();
        $em->persist($comment);
        $em->flush();
    }

    private function dispatchCommentEvent(Comment $comment)
    {
        $event = new GenericEvent($comment);

        $this->eventDispatcher->dispatch(Events::COMMENT_CREATED, $event);
    }
}
