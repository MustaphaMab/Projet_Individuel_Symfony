<?php

namespace App\Entity;

use App\Repository\CategorieRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategorieRepository::class)]
class Categorie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: "Id_Categorie")] 

    private ?int $id = null;

    #[ORM\Column(length: 300)]
    private ?string $Description = null;

    #[ORM\Column(length: 50)]
    private ?string $Nom = null;

    

    public function __toString(): string
    // __toString est une methode dite magique, car elle permet de convertir un objet en chaine de caractère
    {
        return $this->Nom; }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescription(): ?string
    {
        return $this->Description;
    }

    public function setDescription(string $Description): static
    {
        $this->Description = $Description;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->Nom;
    }

    public function setNom(string $Nom): static
    {
        $this->Nom = $Nom;

        return $this;
    }

}


// les Getters permettent d'acceder et lire les valeurs sans modifications
// les Setters permettent d'utiliser et modifier les valeurs des propriétés de l'objet