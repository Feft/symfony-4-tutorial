<?php

namespace App\EventListener;


use App\Entity\LikeNotification;
use App\Entity\MicroPost;
use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\OnFlushEventArgs;
use Doctrine\ORM\Events;
use Doctrine\ORM\PersistentCollection;

class LikeNotificationSubscriber implements EventSubscriber
{

    /**
     * Returns an array of events this subscriber wants to listen to.
     *
     * @return string[]
     */
    public function getSubscribedEvents()
    {
        return [
            Events::onFlush,
        ];
    }

    public function onFlush(OnFlushEventArgs $args)
    {
        $em = $args->getEntityManager();
        $uow = $em->getUnitOfWork();

        /**
         * @var PersistentCollection $collectionUpdate
         */
        foreach($uow->getScheduledCollectionUpdates() as $collectionUpdate) {
            if(!$collectionUpdate->getOwner() instanceof MicroPost) {
                continue;
            }

//            dump($collectionUpdate->getMapping()); die;
            if('likedBy' !== $collectionUpdate->getMapping()["fieldName"]) {
                continue;
            }

            # now we are certain that was updated are represented by likedBy field
            # of the MicroPost entity

            # array of elements that was added to the collection
            $insertDiff = $collectionUpdate->getInsertDiff();

            if(!count($insertDiff)) {
                return;
            }

            /**
             * @var MicroPost $microPost
             */
            $microPost = $collectionUpdate->getOwner();

            $notification = new LikeNotification();
            $notification->setUser($microPost->getUser());
            $notification->setMicroPost($microPost);
            # who like this post?
            $notification->setLikedBy(reset($insertDiff));
            $em->persist($notification);

            # instead flush we must inform about change
            $uow->computeChangeSet(
                $em->getClassMetadata(LikeNotification::class),
                $notification
            );
        }
    }
}