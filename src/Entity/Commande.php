<?php

namespace App\Entity;

use App\Repository\CommandeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommandeRepository::class)]
class Commande
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;


    #[ORM\Column(type: Types::BIGINT)]
    private ?string $Date = null;

    public function __construct()
    {
        $this->paiementCommandes = new ArrayCollection();
    }

    /**
     * @ORM\OneToMany(targetEntity=PaiementCommande::class, mappedBy="Commande")
     */
    private Collection $paiementCommandes;

    

    #[ORM\Column(length: 255)]
    private ?string $Commentaire = null;

   

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?users $users = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?string
    {
        return $this->Date;
    }

    public function setDate(string $Date): static
    {
        $this->Date = $Date;

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

    public function getPaiementCommandes(): Collection
    {
        return $this->paiementCommandes;
    }

    public function addPaiementCommande(PaiementCommande $paiementCommande): self
    {
        if (!$this->paiementCommandes->contains($paiementCommande)) {
            $this->paiementCommandes[] = $paiementCommande;
            $paiementCommande->setCommande($this);
        }

        return $this;
    }

    public function removePaiementCommande(PaiementCommande $paiementCommande): self
    {
        if ($this->paiementCommandes->removeElement($paiementCommande)) {
            // Définit le côté inverse à null (sauf si déjà changé)
            if ($paiementCommande->getCommande() === $this) {
                $paiementCommande->setCommande(null);
            }
        }

        return $this;
    }

    public function getUsers(): ?users
    {
        return $this->users;
    }

    public function setUsers(users $users): static
    {
        $this->users = $users;

        return $this;
    }

   
}
