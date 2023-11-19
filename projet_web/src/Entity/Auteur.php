<?php

namespace App\Entity;

use App\Repository\AuteurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AuteurRepository::class)]
class Auteur
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::BLOB)]
    private $photoAuteur = null;

    #[ORM\Column(length: 60, nullable: true)]
    private ?string $nom = null;

    #[ORM\Column(length: 60)]
    private ?string $prenom = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $dateDeNaissance = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $dateDeMort = null;

    #[ORM\Column(length: 60, nullable: true)]
    private ?string $nationalite = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $biographie = null;

    #[ORM\ManyToMany(targetEntity: livre::class, inversedBy: 'idAuteur')]
    private Collection $idLivre;

    public function __construct()
    {
        $this->idLivre = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPhotoAuteur()
    {
        return $this->photoAuteur;
    }

    public function setPhotoAuteur($photoAuteur): static
    {
        $this->photoAuteur = $photoAuteur;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(?string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): static
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getDateDeNaissance(): ?\DateTimeInterface
    {
        return $this->dateDeNaissance;
    }

    public function setDateDeNaissance(?\DateTimeInterface $dateDeNaissance): static
    {
        $this->dateDeNaissance = $dateDeNaissance;

        return $this;
    }

    public function getDateDeMort(): ?\DateTimeInterface
    {
        return $this->dateDeMort;
    }

    public function setDateDeMort(?\DateTimeInterface $dateDeMort): static
    {
        $this->dateDeMort = $dateDeMort;

        return $this;
    }

    public function getNationalite(): ?string
    {
        return $this->nationalite;
    }

    public function setNationalite(?string $nationalite): static
    {
        $this->nationalite = $nationalite;

        return $this;
    }

    public function getBiographie(): ?string
    {
        return $this->biographie;
    }

    public function setBiographie(?string $biographie): static
    {
        $this->biographie = $biographie;

        return $this;
    }

    /**
     * @return Collection<int, livre>
     */
    public function getIdLivre(): Collection
    {
        return $this->idLivre;
    }

    public function addIdLivre(livre $idLivre): static
    {
        if (!$this->idLivre->contains($idLivre)) {
            $this->idLivre->add($idLivre);
        }

        return $this;
    }

    public function removeIdLivre(livre $idLivre): static
    {
        $this->idLivre->removeElement($idLivre);

        return $this;
    }
}
