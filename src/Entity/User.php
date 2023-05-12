<?php

namespace App\Entity;

use App\Repository\UserRepository;
use App\Traits\TimeStampTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
#[ORM\HasLifecycleCallbacks()]
#[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]
#[UniqueEntity(fields: ['username'], message: 'Username already used')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    use TimeStampTrait;
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true, nullable: false)]
    private string $email ;

    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column(length: 255, nullable: false)]
    private string $password;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateOfBirth = null;

    #[ORM\Column(length: 15, nullable: true)]
    private ?string $gender = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $bio = null;

    #[ORM\OneToMany(mappedBy: 'owner', targetEntity: PasswordResetToken::class, orphanRemoval: true)]
    private Collection $passwordResetTokens;

    #[ORM\OneToMany(mappedBy: 'owner', targetEntity: Post::class, cascade: ['remove'], orphanRemoval: true)]
    private Collection $posts;

    #[ORM\Column(length: 255, unique: true, nullable: false)]
    private string $username ;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $image = null;

    #[ORM\Column(type: 'boolean')]
    private bool $isVerified = false;

    #[ORM\OneToMany(mappedBy: 'owner', targetEntity: Reply::class,cascade: ['remove'], orphanRemoval: true)]
    private Collection $replies;

    #[ORM\Column(nullable: true)]
    private ?bool $hasUnreadNotifications = null;

    #[ORM\OneToMany(mappedBy: 'owner', targetEntity: Comment::class, orphanRemoval: true)]
    private Collection $comment;

    #[ORM\OneToMany(mappedBy: 'owner', targetEntity: Like::class, orphanRemoval: true)]
    private Collection $like;

    #[ORM\OneToMany(mappedBy: 'owner', targetEntity: Notification::class, orphanRemoval: true)]
    private Collection $notifications;

    public function __construct()
    {
        $this->passwordResetTokens = new ArrayCollection();
        $this->posts = new ArrayCollection();
        $this->replies = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getDateOfBirth(): ?\DateTimeInterface
    {
        return $this->dateOfBirth;
    }

    public function setDateOfBirth(\DateTimeInterface $dateOfBirth): self
    {
        $this->dateOfBirth = $dateOfBirth;

        return $this;
    }

    public function getGender(): ?string
    {
        return $this->gender;
    }

    public function setGender(string $gender): self
    {
        $this->gender = $gender;

        return $this;
    }

    public function getBio(): ?string
    {
        return $this->bio;
    }

    public function setBio(?string $bio): self
    {
        $this->bio = $bio;

        return $this;
    }


    /**
     * @return Collection<int, PasswordResetToken>
     */
    public function getPasswordResetTokens(): Collection
    {
        return $this->passwordResetTokens;
    }

    public function addPasswordResetToken(PasswordResetToken $passwordResetToken): self
    {
        if (!$this->passwordResetTokens->contains($passwordResetToken)) {
            $this->passwordResetTokens->add($passwordResetToken);
            $passwordResetToken->setOwner($this);
        }

        return $this;
    }

    public function removePasswordResetToken(PasswordResetToken $passwordResetToken): self
    {
        if ($this->passwordResetTokens->removeElement($passwordResetToken)) {
            // set the owning side to null (unless already changed)
            if ($passwordResetToken->getOwner() === $this) {
                $passwordResetToken->setOwner(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Post>
     */
    public function getPosts(): Collection
    {
        return $this->posts;
    }

    public function addPost(Post $post): self
    {
        if (!$this->posts->contains($post)) {
            $this->posts->add($post);
            $post->setOwner($this);
        }

        return $this;
    }

    public function removePost(Post $post): self
    {
        if ($this->posts->removeElement($post)) {
            // set the owning side to null (unless already changed)
            if ($post->getOwner() === $this) {
                $post->setOwner(null);
            }
        }

        return $this;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function getImageUrl(): ?string
    {
        if (!$this->image) {
            return 'assets/Images/avatar.png';
        }

        if (strpos($this->image, '/') !== false) {
            return $this->image;
        }

        return sprintf('assets/Images/%s', $this->image);
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function isVerified(): bool
    {
        return $this->isVerified;
    }

    public function setIsVerified(bool $isVerified): self
    {
        $this->isVerified = $isVerified;

        return $this;
    }

    /**
     * @return Collection<int, Reply>
     */
    public function getReplies(): Collection
    {
        return $this->replies;
    }

    public function addReply(Reply $reply): self
    {
        if (!$this->replies->contains($reply)) {
            $this->replies->add($reply);
            $reply->setOwner($this);
        }

        return $this;
    }

    public function removeReply(Reply $reply): self
    {
        if ($this->replies->removeElement($reply)) {
            // set the owning side to null (unless already changed)
            if ($reply->getOwner() === $this) {
                $reply->setOwner(null);
            }
        }

        return $this;
    }


    public function getHasUnreadNotifications(): ?bool
    {
        return $this->hasUnreadNotifications;
    }

    public function setHasUnreadNotifications(?bool $hasUnreadNotifications): self
    {
        $this->hasUnreadNotifications = $hasUnreadNotifications;

        return $this;
    }



}
