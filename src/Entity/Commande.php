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
    private ?\DateTimeInterface $dates = null;


    #[ORM\Column(length: 255)]
    private ?string $Commentaire = null;

    #[ORM\Column(type: Types::INTEGER)]
    private ?int $quantite = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(name: "Id_User", referencedColumnName: "Id_user", nullable: false)]
    private ?User $users = null;

    #[ORM\OneToMany(mappedBy: 'commande', targetEntity: LigneCommande::class, cascade: ['persist', 'remove'])]
    private $ligneCommandes;



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDates(): ?string
    {
        return $this->dates;
    }

    public function setDates(\DateTimeInterface $dates): self
    {
        $this->dates = $dates;
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


    public function getUsers(): ?User
    {
        return $this->users;
    }

    public function setUsers(user $users): static
    {
        $this->users = $users;

        return $this;
    }

   

 
}
