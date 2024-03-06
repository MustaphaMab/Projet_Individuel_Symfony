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
    private ?string $Frais_Livraison = null;

    #[ORM\Column(length: 50)]
    private ?string $Transporteur = null;

    #[ORM\Column(type: Types::BIGINT)]
    private ?string $Pods_En_Gramme = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumeroSuivi(): ?string
    {
        return $this->Numero_Suivi;
    }

    public function setNumeroSuivi(string $Numero_Suivi): static
    {
        $this->Numero_Suivi = $Numero_Suivi;

        return $this;
    }

    public function getFraisLivraison(): ?string
    {
        return $this->Frais_Livraison;
    }

    public function setFraisLivraison(string $Frais_Livraison): static
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

    public function getPodsEnGramme(): ?string
    {
        return $this->Pods_En_Gramme;
    }

    public function setPodsEnGramme(string $Pods_En_Gramme): static
    {
        $this->Pods_En_Gramme = $Pods_En_Gramme;

        return $this;
    }
}
