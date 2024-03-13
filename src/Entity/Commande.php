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

    #[ORM\ManyToOne(targetEntity: Users::class, inversedBy: 'commandes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Users $user = null;



    public function __construct()
    {
      
        $this->paiementCommandes = new ArrayCollection();
        $this->Produit = new ArrayCollection();
       
    }

    /**
     * @ORM\OneToMany(targetEntity=PaiementCommande::class, mappedBy="Commande")
     */
    private Collection $paiementCommandes;

    

    #[ORM\Column(length: 255)]
    private ?string $Commentaire = null;

    #[ORM\ManyToMany(targetEntity: Produit::class, inversedBy: 'commandes')]
    private Collection $Produit;


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


    public function getUser(): ?Users
    {
        return $this->user;
    }

    public function setUser(?Users $user): self
    {
        $this->user = $user;

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

    /**
     * @return Collection<int, Produit>
     */
    public function getProduit(): Collection
    {
        return $this->Produit;
    }

    public function addProduit(Produit $produit): static
    {
        if (!$this->Produit->contains($produit)) {
            $this->Produit->add($produit);
        }

        return $this;
    }

    public function removeProduit(Produit $produit): static
    {
        $this->Produit->removeElement($produit);

        return $this;
    }

   
}
