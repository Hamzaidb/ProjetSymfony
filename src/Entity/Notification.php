<?php

namespace App\Entity;

use App\Repository\NotificationRepository;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\User;

#[ORM\Entity(repositoryClass: NotificationRepository::class)]
class Notification
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 100)]
    private ?string $type = null;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $label = null;

    #[ORM\Column(type: 'text', nullable: true)]
    private ?string $message = null;

    #[ORM\ManyToOne(targetEntity: User::class)]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    #[ORM\Column(type: 'datetime_immutable')]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column(type: 'datetime_immutable')]
    private ?\DateTimeImmutable $updatedAt = null;

 
public function getId(): ?int
{
    return $this->id;
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

public function getLabel(): ?string
{
    return $this->label;
}

public function setLabel(string $label): self
{
    $this->label = $label;
    return $this;
}

public function getMessage(): ?string
{
    return $this->message;
}

public function setMessage(?string $message): self
{
    $this->message = $message;
    return $this;
}

public function getUser(): ?User
{
    return $this->user;
}

public function setUser(?User $user): self
{
    $this->user = $user;
    return $this;
}

public function getCreatedAt(): ?\DateTimeImmutable
{
    return $this->createdAt;
}

public function setCreatedAt(\DateTimeImmutable $createdAt): self
{
    $this->createdAt = $createdAt;
    return $this;
}

public function getUpdatedAt(): ?\DateTimeImmutable
{
    return $this->updatedAt;
}

public function setUpdatedAt(\DateTimeImmutable $updatedAt): self
{
    $this->updatedAt = $updatedAt;
    return $this;
}
}