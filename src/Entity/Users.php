<?php

namespace App\Entity;

use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use App\Repository\UsersRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

use Doctrine\Common\Collections\Collection; // Ajoute cette ligne
use Doctrine\Common\Collections\ArrayCollection;

#[ORM\Entity(repositoryClass: UsersRepository::class)]
class Users implements PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $Role = null;

    #[ORM\Column(length: 50)]
    private ?string $Nom = null;

    #[ORM\Column(length: 50)]
    private ?string $Prenom = null;

    #[ORM\Column(length: 255)]
    private ?string $MdP = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $Date_Naissance = null;

    #[ORM\Column(type: Types::BIGINT)]
    private ?string $Telephone = null;

    #[ORM\Column(length: 255)]
    private ?string $Adresse = null;

    #[ORM\OneToMany(targetEntity: Commande::class, mappedBy: 'user')]
    private Collection $commandes;

    public function __construct()
    {
        $this->commandes = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRole(): ?string
    {
        return $this->Role;
    }

    public function setRole(string $Role): static
    {
        $this->Role = $Role;

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

    public function getPrenom(): ?string
    {
        return $this->Prenom;
    }

    public function setPrenom(string $Prenom): static
    {
        $this->Prenom = $Prenom;

        return $this;
    }

    public function getMdP(): ?string
    {
        return $this->MdP;
    }

    public function setMdP(string $MdP): static
    {
        $this->MdP = $MdP;

        return $this;
    }

    public function getPassword(): string
    {
        return $this->MdP;
    }

    public function getDateNaissance(): ?\DateTimeInterface
    {
        return $this->Date_Naissance;
    }

    public function setDateNaissance(\DateTimeInterface $Date_Naissance): static
    {
        $this->Date_Naissance = $Date_Naissance;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->Telephone;
    }

    public function setTelephone(string $Telephone): static
    {
        $this->Telephone = $Telephone;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->Adresse;
    }

    public function setAdresse(string $Adresse): static
    {
        $this->Adresse = $Adresse;

        return $this;
    }


/**
 * @return Collection<int, Commande>
 */
public function getCommandes(): Collection
{
    return $this->commandes;
}

public function addCommande(Commande $commande): self
{
    if (!$this->commandes->contains($commande)) {
        $this->commandes[] = $commande;
        $commande->setUser($this);
    }

    return $this;
}

public function removeCommande(Commande $commande): self
{
    if ($this->commandes->removeElement($commande)) {
        // set the owning side to null (unless already changed)
        if ($commande->getUser() === $this) {
            $commande->setUser(null);
        }
    }

    return $this;
}
}
