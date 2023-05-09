<?php

namespace App\Entity;

use   App\Repository\NotificationRepository;
use App\Traits\TimeStampTrait;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: NotificationRepository::class)]
#[ORM\HasLifecycleCallbacks()]
class Notification
{
    use TimeStampTrait;
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $owner = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Post $targetPost = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $type = null;

    #[ORM\Column]
    private ?bool $isRead = null;

    #[ORM\OneToOne(inversedBy: 'notification', cascade: ['persist', 'remove'])]
    private ?Like $forLike = null;

    #[ORM\OneToOne(inversedBy: 'notification', cascade: ['persist', 'remove'])]
    private ?Comment $comment = null;



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

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function isIsRead(): ?bool
    {
        return $this->isRead;
    }

    public function setIsRead(bool $isRead): void
    {
        $this->isRead = $isRead;
        if ($isRead === false) {
            // Update the corresponding NotificationState entity
            $this->getTargetPost()->getOwner()->setHasUnreadNotifications(true);
        }
    }

    public function getForLike(): ?Like
    {
        return $this->forLike;
    }

    public function setForLike(?Like $forLike): self
    {
        $this->forLike = $forLike;

        return $this;
    }

    public function getComment(): ?Comment
    {
        return $this->comment;
    }

    public function setComment(?Comment $comment): self
    {
        $this->comment = $comment;

        return $this;
    }

}
