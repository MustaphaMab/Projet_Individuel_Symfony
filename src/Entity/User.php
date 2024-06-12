<?php

namespace App\Entity;

use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use App\Repository\UserRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: UserRepository::class)]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: "Id_user")]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $Nom = null;

    #[ORM\Column(length: 50)]
    private ?string $Prenom = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank]
    #[Assert\Length(min: 8, minMessage: "Le mot de passe doit comporter au moins {{ limit }} caractères.")]
    #[Assert\Regex(
        pattern: "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/",
        message: "Le mot de passe doit contenir au moins une lettre majuscule, une lettre minuscule et un chiffre."
    )]
    private ?string $MdP = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $Date_Naissance = null;

    #[ORM\Column(type: Types::BIGINT)]
    private ?string $Telephone = null;

    #[ORM\Column(length: 255)]
    private ?string $Adresse = null;

    #[ORM\Column(type: "string", length: 180, unique: true)]
    private ?string $email = null;

    #[ORM\Column(type: Types::BIGINT)]
    private ?string $Code_Postale = null;

    #[ORM\Column(length: 50)]
    private ?string $Pays = null;

    #[ORM\Column(type: "json")]
    private array $roles = [];

    public function __toString(): string
    {
        return $this->email;
    }

    public function getRoles(): array
    {
        $roles = $this->roles;
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;
        return $this;
    }

    public function getUserIdentifier(): string
    {
        return $this->email;
    }

    public function getSalt(): ?string
    {
        return null;
    }

    public function getUsername(): string
    {
        return $this->email;
    }

    public function eraseCredentials(): void
    {
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->Nom;
    }

    public function setNom(string $Nom): self
    {
        $this->Nom = $Nom;
        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->Prenom;
    }

    public function setPrenom(string $Prenom): self
    {
        $this->Prenom = $Prenom;
        return $this;
    }

    public function getMdP(): ?string
    {
        return $this->MdP;
    }

    public function setMdP(string $MdP): self
    {
        $this->MdP = $MdP;
        return $this;
    }

    public function getPassword(): string
    {
        return $this->MdP;
    }

    public function setPassword(string $password): self
    {
        $this->MdP = $password;
        return $this;
    }

    public function getDateNaissance(): ?\DateTimeInterface
    {
        return $this->Date_Naissance;
    }

    public function setDateNaissance(\DateTimeInterface $Date_Naissance): self
    {
        $this->Date_Naissance = $Date_Naissance;
        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->Telephone;
    }

    public function setTelephone(string $Telephone): self
    {
        $this->Telephone = $Telephone;
        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->Adresse;
    }

    public function setAdresse(string $Adresse): self
    {
        $this->Adresse = $Adresse;
        return $this;
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

    public function getCodePostale(): ?string
    {
        return $this->Code_Postale;
    }

    public function setCodePostale(string $Code_Postale): self
    {
        $this->Code_Postale = $Code_Postale;
        return $this;
    }

    public function getPays(): ?string
    {
        return $this->Pays;
    }

    public function setPays(string $Pays): self
    {
        $this->Pays = $Pays;
        return $this;
    }
}
