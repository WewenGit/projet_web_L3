<?php

namespace App\Entity;

use App\Repository\UtilisateurRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\File;

#[ORM\Entity(repositoryClass: UtilisateurRepository::class)]
#[UniqueEntity(fields: ['pseudo'], message: 'There is already an account with this pseudo')]
#[Vich\Uploadable]
class Utilisateur implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    private ?string $pseudo = null;

    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[Vich\UploadableField(mapping: 'utilisateurs', fileNameProperty: 'photo_profil')]
    private ?File $fichierImage = null;

    #[ORM\Column(length: 255)]
    private ?string $photo_profil = null;

    //Champ obligatoire à ajouter pour pouvoir update des fichiers dans la BDD
    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $majPhotoProfil = null;

    #[ORM\Column(length: 255)]
    private ?string $mail = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Auteur $id_auteur = null;

    #[ORM\Column(type: 'boolean')]
    private $isVerified = false;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPseudo(): ?string
    {
        return $this->pseudo;
    }

    public function setPseudo(string $pseudo): static
    {
        $this->pseudo = $pseudo;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->pseudo;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
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

    public function getPhotoProfil()
    {
        return $this->photo_profil;
    }

    public function setPhotoProfil($photo_profil): static
    {
        $this->photo_profil = $photo_profil;

        return $this;
    }

    public function setMajPhotoProfil(?\DateTimeInterface $majPhotoProfil)
    {
        $this->majPhotoProfil = $majPhotoProfil;
    }

    public function getMajPhotoProfil(): ?\DateTimeInterface
    {
        return $this->majPhotoProfil;
    }  

    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(string $mail): static
    {
        $this->mail = $mail;

        return $this;
    }

    public function getIdAuteur(): ?auteur
    {
        return $this->id_auteur;
    }

    public function setIdAuteur(?auteur $id_auteur): static
    {
        $this->id_auteur = $id_auteur;

        return $this;
    }

    public function isVerified(): bool
    {
        return $this->isVerified;
    }

    public function setIsVerified(bool $isVerified): static
    {
        $this->isVerified = $isVerified;

        return $this;
    }
}
