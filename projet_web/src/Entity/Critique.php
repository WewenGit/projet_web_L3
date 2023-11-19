<?php

namespace App\Entity;

use App\Repository\CritiqueRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CritiqueRepository::class)]
class Critique
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $note = null;

    #[ORM\Column(length: 255)]
    private ?string $commentaire = null;

    #[ORM\ManyToOne(inversedBy: 'critiques')]
    #[ORM\JoinColumn(nullable: false)]
    private ?utilisateur $idUtilisateur = null;

    #[ORM\ManyToOne(inversedBy: 'critiques')]
    #[ORM\JoinColumn(nullable: false)]
    private ?livre $idLivre = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNote(): ?int
    {
        return $this->note;
    }

    public function setNote(int $note): static
    {
        $this->note = $note;

        return $this;
    }

    public function getCommentaire(): ?string
    {
        return $this->commentaire;
    }

    public function setCommentaire(string $commentaire): static
    {
        $this->commentaire = $commentaire;

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

    public function getIdLivre(): ?livre
    {
        return $this->idLivre;
    }

    public function setIdLivre(?livre $idLivre): static
    {
        $this->idLivre = $idLivre;

        return $this;
    }
}
