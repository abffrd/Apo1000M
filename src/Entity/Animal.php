<?php

namespace App\Entity;

use App\Repository\AnimalRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AnimalRepository::class)
 */
class Animal
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $date_naissance;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $statut;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $tests;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $sexe;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $vaccins;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $photo;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $commentaire;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $identification;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $sterilise;

    /**
     * @ORM\ManyToOne(targetEntity=FamilleAccueil::class, inversedBy="animaux")
     */
    private $familleAccueil;

    /**
     * @ORM\ManyToOne(targetEntity=Espece::class, inversedBy="animaux")
     */
    private $espece;

    /**
     * @ORM\ManyToOne(targetEntity="Adoption", inversedBy="animal")
     * @ORM\JoinTable(name="adoption")
     */
    private $adoption;

   
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getDateNaissance(): ?\DateTimeInterface
    {
        return $this->date_naissance;
    }

    public function setDateNaissance(?\DateTimeInterface $date_naissance): self
    {
        $this->date_naissance = $date_naissance;

        return $this;
    }

    public function getStatut(): ?string
    {
        return $this->statut;
    }

    public function setStatut(?string $statut): self
    {
        $this->statut = $statut;

        return $this;
    }

    public function getTests(): ?string
    {
        return $this->tests;
    }

    public function setTests(?string $tests): self
    {
        $this->tests = $tests;

        return $this;
    }

    public function getSexe(): ?string
    {
        return $this->sexe;
    }

    public function setSexe(?string $sexe): self
    {
        $this->sexe = $sexe;

        return $this;
    }

    public function getVaccins(): ?string
    {
        return $this->vaccins;
    }

    public function setVaccins(?string $vaccins): self
    {
        $this->vaccins = $vaccins;

        return $this;
    }

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(?string $photo): self
    {
        $this->photo = $photo;

        return $this;
    }

    public function getCommentaire(): ?string
    {
        return $this->commentaire;
    }

    public function setCommentaire(?string $commentaire): self
    {
        $this->commentaire = $commentaire;

        return $this;
    }

    public function getIdentification(): ?string
    {
        return $this->identification;
    }

    public function setIdentification(?string $identification): self
    {
        $this->identification = $identification;

        return $this;
    }

    public function getSterilise(): ?bool
    {
        return $this->sterilise;
    }

    public function setSterilise(?bool $sterilise): self
    {
        $this->sterilise = $sterilise;

        return $this;
    }

    public function getFamilleAccueil(): ?FamilleAccueil
    {
        return $this->familleAccueil;
    }

    public function setFamilleAccueil(?FamilleAccueil $familleAccueil): self
    {
        $this->familleAccueil = $familleAccueil;

        return $this;
    }

    public function getEspece(): ?Espece
    {
        return $this->espece;
    }

    public function setEspece(?Espece $espece): self
    {
        $this->espece = $espece;

        return $this;
    }

    public function getAdoption(): ?Adoption
    {
        return $this->adoption;
    }

    public function setAdoption(?Adoption $adoption): self
    {
        $this->adoption = $adoption;

        return $this;
    }
}
