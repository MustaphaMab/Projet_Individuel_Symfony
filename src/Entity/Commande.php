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

    #[ORM\Column(length: 50)]
    private ?string $Validation = null;

    #[ORM\Column(length: 50)]
    private ?string $Statut = null;

    #[ORM\Column(type: Types::BIGINT)]
    private ?string $Date = null;

    #[ORM\Column(length: 50)]
    private ?string $Suivi = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2)]
    private ?string $Montant = null;




    #[ORM\OneToMany(targetEntity: PaiementCommande::class, mappedBy: 'Commande')]
    private Collection $paiementCommandes;

    #[ORM\OneToMany(targetEntity: LigneCommande::class, mappedBy: 'Id_commmande')]
    private Collection $ligneCommandes;

    #[ORM\ManyToOne(targetEntity: Users::class, inversedBy: 'commandes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Users $user = null;


    public function __construct()
    {
        $this->paiementCommandes = new ArrayCollection();
        $this->ligneCommandes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getValidation(): ?string
    {
        return $this->Validation;
    }

    public function setValidation(string $Validation): static
    {
        $this->Validation = $Validation;

        return $this;
    }

    public function getStatut(): ?string
    {
        return $this->Statut;
    }

    public function setStatut(string $Statut): static
    {
        $this->Statut = $Statut;

        return $this;
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

    public function getSuivi(): ?string
    {
        return $this->Suivi;
    }

    public function setSuivi(string $Suivi): static
    {
        $this->Suivi = $Suivi;

        return $this;
    }

    public function getMontant(): ?string
    {
        return $this->Montant;
    }

    public function setMontant(string $Montant): static
    {
        $this->Montant = $Montant;

        return $this;
    }



    /**
     * @return Collection<int, PaiementCommande>
     */
    public function getPaiementCommandes(): Collection
    {
        return $this->paiementCommandes;
    }

    public function addPaiementCommande(PaiementCommande $paiementCommande): static
    {
        if (!$this->paiementCommandes->contains($paiementCommande)) {
            $this->paiementCommandes->add($paiementCommande);
            $paiementCommande->setCommande($this);
        }

        return $this;
    }

    public function removePaiementCommande(PaiementCommande $paiementCommande): static
    {
        if ($this->paiementCommandes->removeElement($paiementCommande)) {
            // set the owning side to null (unless already changed)
            if ($paiementCommande->getCommande() === $this) {
                $paiementCommande->setCommande(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, LigneCommande>
     */
    public function getLigneCommandes(): Collection
    {
        return $this->ligneCommandes;
    }

    public function addLigneCommande(LigneCommande $ligneCommande): static
    {
        if (!$this->ligneCommandes->contains($ligneCommande)) {
            $this->ligneCommandes->add($ligneCommande);
            $ligneCommande->setCommande($this);
        }

        return $this;
    }

    public function removeLigneCommande(LigneCommande $ligneCommande): static
    {
        if ($this->ligneCommandes->removeElement($ligneCommande)) {
            // set the owning side to null (unless already changed)
            if ($ligneCommande->getCommande() === $this) {
                $ligneCommande->setCommande(null);
            }
        }

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
}
