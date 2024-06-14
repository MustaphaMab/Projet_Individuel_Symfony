<?php

namespace App\Entity;

use App\Repository\ProduitRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProduitRepository::class)]
class Produit
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: "Id_Produit", type: "integer")]
    private ?int $id = null;

    #[ORM\Column(name: "nom", type: "string", length: 50)]
    private ?string $nom = null;

    #[ORM\Column(name: "stock", type: Types::BIGINT)]
    private ?string $stock = null;

    #[ORM\Column(name: "description", type: "string", length: 300)]
    private ?string $description = null;

    #[ORM\Column(name: "photo", type: "string", length: 300)]
    private ?string $photo = null;

    #[ORM\Column(name: "prix", type: Types::DECIMAL, precision: 10, scale: 2)]
    private ?string $prix = null;

    #[ORM\ManyToOne(targetEntity: Categorie::class, inversedBy: "produits")]
    #[ORM\JoinColumn(name: "Id_Categorie", referencedColumnName: "Id_Categorie", nullable: false)]
    private ?Categorie $categorie = null;

    #[ORM\Column(name: "couleur", type: "string", length: 255)]
    private ?string $couleur = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;
        return $this;
    }

    public function getStock(): ?string
    {
        return $this->stock;
    }

    public function setStock(string $stock): static
    {
        $this->stock = $stock;
        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;
        return $this;
    }

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(string $photo): static
    {
        $this->photo = $photo;
        return $this;
    }

    public function getPrix(): ?string
    {
        return $this->prix;
    }

    public function setPrix(string $prix): static
    {
        $this->prix = $prix;
        return $this;
    }

    public function getCategorie(): ?Categorie
    {
        return $this->categorie;
    }

    public function setCategorie(?Categorie $categorie): static
    {
        $this->categorie = $categorie;
        return $this;
    }

    public function getCouleur(): ?string
    {
        return $this->couleur;
    }

    public function setCouleur(string $couleur): static
    {
        $this->couleur = $couleur;
        return $this;
    }
}
