<?php

namespace App\Entity;

use App\Repository\ListeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ListeRepository::class)]
class Liste
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 60)]
    private ?string $nomListe = null;

    #[ORM\ManyToOne(inversedBy: 'listes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Utilisateur $idUtilisateur = null;

    #[ORM\ManyToMany(targetEntity: Livre::class, inversedBy: 'idListe')]
    private Collection $idLivre;

    public function __construct()
    {
        $this->idLivre = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomListe(): ?string
    {
        return $this->nomListe;
    }

    public function setNomListe(string $nomListe): static
    {
        $this->nomListe = $nomListe;

        return $this;
    }

    public function getIdUtilisateur(): ?utilisateur
    {
        return $this->idUtilisateur;
    }

    public function setIdUtilisateur(?utilisateur $idUtilisateur): static
    {
        $this->idUtilisateur = $idUtilisateur;

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
