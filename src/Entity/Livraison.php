<?php

namespace App\Entity;

use App\Repository\LivraisonRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LivraisonRepository::class)]
class Livraison
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $Numero_Suivi = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2)]
    private ?float $Frais_Livraison = null;

    #[ORM\Column(length: 50)]
    private ?string $Transporteur = null;

    #[ORM\Column(type: Types::BIGINT)]
    private ?string $Poids_En_Gramme = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Commande $Commande = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?PaiementCommande $Paiement_Commande = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumeroSuivi(): ?string
    {
        return $this->Numero_Suivi;
    }

    public function setNumeroSuivi(string $Numero_Suivi): self
    {
        $this->Numero_Suivi = $Numero_Suivi;
        return $this;
    }


    public function getFrais_Livraison(): ?float
    {
        return $this->Frais_Livraison;
    }

    public function setFrais_Livraison(float $Frais_Livraison): self
    {
        $this->Frais_Livraison = $Frais_Livraison;
        return $this;
    }


    public function getTransporteur(): ?string
    {
        return $this->Transporteur;
    }

    public function setTransporteur(string $Transporteur): static
    {
        $this->Transporteur = $Transporteur;

        return $this;
    }


    public function getPoids_En_Gramme(): ?int
    {
        return $this->Poids_En_Gramme;
    }

    public function setPoids_En_Gramme(int $Poids_En_Gramme): self
    {
        $this->Poids_En_Gramme = $Poids_En_Gramme;
        return $this;
    }


    public function getCommande(): ?Commande
    {
        return $this->Commande;
    }

    public function setCommande(?Commande $Commande): static
    {
        $this->Commande = $Commande;

        return $this;
    }

    public function getPaiementCommande(): ?PaiementCommande
    {
        return $this->Paiement_Commande;
    }

    public function setPaiementCommande(?PaiementCommande $Paiement_Commande): static
    {
        $this->Paiement_Commande = $Paiement_Commande;

        return $this;
    }
}
