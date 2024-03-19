<?php

namespace App\Entity;

use App\Repository\CommandeRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommandeRepository::class)]
class Commande
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: "Id_Commande")]
    private ?int $id = null;


    #[ORM\Column(type: Types::DATE_IMMUTABLE)]
private ?\DateTimeInterface $date = null;

  
    #[ORM\Column(length: 255)]
    private ?string $Commentaire = null;

   

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(name: "Id_User", referencedColumnName: "Id_User",nullable: false)]
    private ?User $users = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?string
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;
        return $this;
    }

    public function getCommentaire(): ?string
    {
        return $this->Commentaire;
    }

    public function setCommentaire(string $Commentaire): static
    {
        $this->Commentaire = $Commentaire;

        return $this;
    }


    public function getUser(): ?User
    {
        return $this->users;
    }

    public function setUser(user $users): static
    {
        $this->users = $users;

        return $this;
    }

   
}
