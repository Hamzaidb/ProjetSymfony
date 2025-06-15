<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;


#[ORM\Entity(repositoryClass: UserRepository::class)]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 180, unique: true)]
    private ?string $email = null;

    #[ORM\Column(type: 'json')]
    private array $roles = [];

    #[ORM\Column(type: 'string')]
    private ?string $password = null;

    #[ORM\Column(type: 'string', length: 100)]
    private ?string $nom = null;

    #[ORM\Column(type: 'string', length: 100, nullable: true)]
    private ?string $prenom = null;

    #[ORM\Column(type: 'integer')]
    private ?int $points = 0;

    #[ORM\Column(type: 'boolean')]
    private bool $actif = true;


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

public function getRoles(): array
{
    $roles = $this->roles;
    // guarantee every user at least has ROLE_USER
    if (!in_array('ROLE_USER', $roles)) {
        $roles[] = 'ROLE_USER';
    }
    return array_unique($roles);
}

public function setRoles(array $roles): self
{
    $this->roles = $roles;
    return $this;
}

public function getPassword(): ?string
{
    return $this->password;
}

public function setPassword(string $password): self
{
    $this->password = $password;
    return $this;
}

public function getNom(): ?string
{
    return $this->nom;
}

public function setNom(string $nom): self
{
    $this->nom = $nom;
    return $this;
}

public function getPrenom(): ?string
{
    return $this->prenom;
}

public function setPrenom(?string $prenom): self
{
    $this->prenom = $prenom;
    return $this;
}

public function getPoints(): ?int
{
    return $this->points;
}

public function setPoints(int $points): self
{
    $this->points = $points;
    return $this;
}

public function isActif(): bool
{
    return $this->actif;
}

public function setActif(bool $actif): self
{
    $this->actif = $actif;
    return $this;
}

// Méthodes UserInterface

public function getUserIdentifier(): string
{
    return (string) $this->email;
}

public function eraseCredentials(): void
{
    // If you store any temporary, sensitive data on the user, clear it here
}

public function getSalt(): ?string
{
    // Not needed for modern algorithms
    return null;
}
}