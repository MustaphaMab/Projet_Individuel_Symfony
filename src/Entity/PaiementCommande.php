<?php

namespace App\Entity;

use App\Repository\PaiementCommandeRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PaiementCommandeRepository::class)]
class PaiementCommande
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name:"Id_Paiement_Commande")]
    private ?int $id = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2)]
    private ?string $Montant = null;

    #[ORM\Column(length: 50)]
    private ?string $Methode = null;

    #[ORM\Column(length: 50)]
    private ?string $Statut = null;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE)] 
    private ?\DateTimeInterface $dates = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false, name:"Id_Commande", referencedColumnName: "Id_Commande")]
    private ?Commande $Commande = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMontant(): ?string
    {
        return $this->Montant;
    }

    public function setMontant(float $Montant): static
    {
        $this->Montant = $Montant;

        return $this;
    }

    public function getMethode(): ?string
    {
        return $this->Methode;
    }

    public function setMethode(string $Methode): static
    {
        $this->Methode = $Methode;

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

    public function getDate(): ?\DateTimeInterface
    {
        return $this->dates;
    }

    public function setDate(\DateTimeInterface $dates): self
    {
        $this->dates = $dates;
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



   
}
