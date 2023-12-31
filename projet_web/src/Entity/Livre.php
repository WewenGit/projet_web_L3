<?php

namespace App\Entity;

use App\Repository\LivreRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

#[ORM\Entity(repositoryClass: LivreRepository::class)]
#[Vich\Uploadable]
class Livre
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Vich\UploadableField(mapping: 'livres', fileNameProperty: 'couverture')]
    private ?File $fichierImage = null;

    #[ORM\Column(length: 100)]
    private ?string $couverture = null;

    //Champ obligatoire à ajouter pour pouvoir update des fichiers dans la BDD
    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $majCouverture = null;

    #[ORM\Column(length: 100)]
    private ?string $titre = null;

    #[ORM\Column]
    private ?int $nbPages = null;

    #[ORM\OneToMany(mappedBy: 'idLivre', targetEntity: Critique::class)]
    private Collection $critiques;

    #[ORM\ManyToOne(inversedBy: 'livres')]
    private ?Genre $idGenre = null;

    #[ORM\ManyToOne(inversedBy: 'livres')]
    private ?Editeur $idEditeur = null;

    #[ORM\ManyToMany(targetEntity: Auteur::class, inversedBy: 'idLivre')]
    private Collection $idAuteur;

    #[ORM\ManyToMany(targetEntity: Liste::class, mappedBy: 'idLivre')]
    private Collection $idListe;

    #[ORM\Column]
    private ?bool $valide = null;

    public function __construct()
    {
        $this->critiques = new ArrayCollection();
        $this->idAuteur = new ArrayCollection();
        $this->idListe = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setFichierImage(?File $fichierImage = null): void
    {
        $this->fichierImage = $fichierImage;

        if (null !== $fichierImage) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    public function getFichierImage(): ?File
    {
        return $this->fichierImage;
    }

    public function getCouverture()
    {
        return $this->couverture;
    }

    public function setCouverture($couverture): static
    {
        $this->couverture = $couverture;

        return $this;
    }

    public function setMajCouverture(?\DateTimeInterface $majCouverture)
    {
        $this->majCouverture = $majCouverture;
    }

    public function getMajCouverture(): ?\DateTimeInterface
    {
        return $this->majCouverture;
    }   

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): static
    {
        $this->titre = $titre;

        return $this;
    }

    public function getNbPages(): ?int
    {
        return $this->nbPages;
    }

    public function setNbPages(int $nbPages): static
    {
        $this->nbPages = $nbPages;

        return $this;
    }

    /**
     * @return Collection<int, Critique>
     */
    public function getCritiques(): Collection
    {
        return $this->critiques;
    }

    public function addCritique(Critique $critique): static
    {
        if (!$this->critiques->contains($critique)) {
            $this->critiques->add($critique);
            $critique->setIdLivre($this);
        }

        return $this;
    }

    public function removeCritique(Critique $critique): static
    {
        if ($this->critiques->removeElement($critique)) {
            // set the owning side to null (unless already changed)
            if ($critique->getIdLivre() === $this) {
                $critique->setIdLivre(null);
            }
        }

        return $this;
    }

    public function getIdGenre(): ?Genre
    {
        return $this->idGenre;
    }

    public function setIdGenre(?Genre $idGenre): static
    {
        $this->idGenre = $idGenre;

        return $this;
    }

    public function getIdEditeur(): ?Editeur
    {
        return $this->idEditeur;
    }

    public function setIdEditeur(?Editeur $idEditeur): static
    {
        $this->idEditeur = $idEditeur;

        return $this;
    }

    /**
     * @return Collection<int, Auteur>
     */
    public function getIdAuteur(): Collection
    {
        return $this->idAuteur;
    }

    public function addIdAuteur(Auteur $idAuteur): static
    {
        if (!$this->idAuteur->contains($idAuteur)) {
            $this->idAuteur->add($idAuteur);
            $idAuteur->addIdLivre($this);
        }

        return $this;
    }

    public function removeIdAuteur(Auteur $idAuteur): static
    {
        if ($this->idAuteur->removeElement($idAuteur)) {
            $idAuteur->removeIdLivre($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Liste>
     */
    public function getIdListe(): Collection
    {
        return $this->idListe;
    }

    public function addIdListe(Liste $idListe): static
    {
        if (!$this->idListe->contains($idListe)) {
            $this->idListe->add($idListe);
            $idListe->addIdLivre($this);
        }

        return $this;
    }

    public function removeIdListe(Liste $idListe): static
    {
        if ($this->idListe->removeElement($idListe)) {
            $idListe->removeIdLivre($this);
        }

        return $this;
    }

    public function isValide(): ?bool
    {
        return $this->valide;
    }

    public function setValide(bool $valide): static
    {
        $this->valide = $valide;

        return $this;
    }
}
