<?php

namespace App\Entity;

use App\Repository\LikeRepository;
use App\Traits\TimeStampTrait;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LikeRepository::class)]
#[ORM\HasLifecycleCallbacks()]
#[ORM\Table(name: '`like`')]
class Like
{
    use TimeStampTrait;
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $owner = null;

    #[ORM\ManyToOne(inversedBy: 'likes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Post $targetPost = null;

    #[ORM\OneToOne(mappedBy: 'forLike', targetEntity: Notification::class, cascade: ['persist','remove'], orphanRemoval: true)]
    #[ORM\JoinColumn(nullable: true)]
    private ?Notification $notification = null;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOwner(): ?User
    {
        return $this->owner;
    }

    public function setOwner(?User $owner): self
    {
        $this->owner = $owner;

        return $this;
    }

    public function getTargetPost(): ?Post
    {
        return $this->targetPost;
    }

    public function setTargetPost(?Post $targetPost): self
    {
        $this->targetPost = $targetPost;

        return $this;
    }

    public function getNotification(): ?Notification
    {
        return $this->notification;
    }

    public function setNotification(?Notification $notification): self
    {
        // unset the owning side of the relation if necessary
        if ($notification === null && $this->notification !== null) {
            $this->notification->setForLike(null);
        }

        // set the owning side of the relation if necessary
        if ($notification !== null && $notification->getForLike() !== $this) {
            $notification->setForLike($this);
        }

        $this->notification = $notification;

        return $this;
    }

}
