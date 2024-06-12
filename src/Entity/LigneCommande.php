<?php
namespace App\Entity;

use App\Repository\LigneCommandeRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LigneCommandeRepository::class)]
class LigneCommande
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: "Id_Ligne_Commande")]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: Commande::class, inversedBy: 'ligneCommandes')]
    #[ORM\JoinColumn(name: "Id_Commande", referencedColumnName: "Id_Commande", nullable: false)]
    private ?Commande $Commande = null;

    #[ORM\ManyToOne(targetEntity: Produit::class)]
    #[ORM\JoinColumn(name: "Id_Produit", referencedColumnName: "Id_Produit", nullable: false)]
    private ?Produit $Produit = null;

    #[ORM\Column(type: Types::INTEGER)]
    private ?int $Quantite = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 5, scale: 2)]
    private ?string $Prix_Total = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCommande(): ?Commande
    {
        return $this->Commande;
    }

    public function setCommande(?Commande $Commande): self
    {
        $this->Commande = $Commande;
        return $this;
    }

    public function getProduit(): ?Produit
    {
        return $this->Produit;
    }

    public function setProduit(?Produit $Produit): self
    {
        $this->Produit = $Produit;
        return $this;
    }

    public function getQuantite(): ?int
    {
        return $this->Quantite;
    }

    public function setQuantite(int $Quantite): self
    {
        $this->Quantite = $Quantite;
        return $this;
    }

    public function getPrixTotal(): ?string
    {
        return $this->Prix_Total;
    }

    public function setPrixTotal(string $Prix_Total): self
    {
        $this->Prix_Total = $Prix_Total;
        return $this;
    }
}
