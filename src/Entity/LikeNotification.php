<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LikeNotificationRepository")
 */
class LikeNotification extends Notification
{
    /**
     * @var MicroPost
     * @ORM\ManyToOne(targetEntity="App\Entity\MicroPost")
     */
    private $microPost;

    /**
     * @var User
     * @ORM\ManyToOne(targetEntity="App\Entity\User")
     */
    private $likedBy;

    /**
     * @return MicroPost
     */
    public function getMicroPost(): MicroPost
    {
        return $this->microPost;
    }

    /**
     * @param MicroPost $microPost
     */
    public function setMicroPost(MicroPost $microPost): void
    {
        $this->microPost = $microPost;
    }

    /**
     * @return User
     */
    public function getLikedBy(): User
    {
        return $this->likedBy;
    }

    /**
     * @param User $likedBy
     */
    public function setLikedBy(User $likedBy): void
    {
        $this->likedBy = $likedBy;
    }
}
