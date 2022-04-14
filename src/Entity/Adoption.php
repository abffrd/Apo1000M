<?php

namespace App\Entity;

use App\Repository\AdoptionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AdoptionRepository::class)
 */
class Adoption
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;


    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $date_appel;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $compte_rendu;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $retour_animaux_proposes;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $date_rencontre;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $retour_rencontre_adoptant;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $retour_rencontre_fa;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $date_visite;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $retour_visite;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $date_adoption;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $date_depart;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $remarque;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $statut;

    /**
     * @ORM\ManyToOne(targetEntity=Adoptant::class, inversedBy="adoptions")
     */
    private $adoptant;

    

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $animaux_proposes;



    /**
     * @ORM\ManyToMany(targetEntity=User::class, inversedBy="adoptions")
     * @ORM\JoinTable(name="user_adoption")
     */
    private $users;

    /**
     * @ORM\OneToMany(targetEntity="Animal", mappedBy="adoption")
     * @ORM\JoinTable(name="animal")
     */
    private $animal;

    public function __construct()
    {
        $this->users = new ArrayCollection();
        $this->animal = new ArrayCollection();
    }
    

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateAppel(): ?\DateTimeInterface
    {
        return $this->date_appel;
    }

    public function setDateAppel(?\DateTimeInterface $date_appel): self
    {
        $this->date_appel = $date_appel;

        return $this;
    }

    public function getCompteRendu(): ?string
    {
        return $this->compte_rendu;
    }

    public function setCompteRendu(?string $compte_rendu): self
    {
        $this->compte_rendu = $compte_rendu;

        return $this;
    }

    public function getRetourAnimauxProposes(): ?string
    {
        return $this->retour_animaux_proposes;
    }

    public function setRetourAnimauxProposes(?string $retour_animaux_proposes): self
    {
        $this->retour_animaux_proposes = $retour_animaux_proposes;

        return $this;
    }

    public function getDateRencontre(): ?\DateTimeInterface
    {
        return $this->date_rencontre;
    }

    public function setDateRencontre(?\DateTimeInterface $date_rencontre): self
    {
        $this->date_rencontre = $date_rencontre;

        return $this;
    }

    public function getRetourRencontreAdoptant(): ?string
    {
        return $this->retour_rencontre_adoptant;
    }

    public function setRetourRencontreAdoptant(?string $retour_rencontre_adoptant): self
    {
        $this->retour_rencontre_adoptant = $retour_rencontre_adoptant;

        return $this;
    }

    public function getRetourRencontreFa(): ?string
    {
        return $this->retour_rencontre_fa;
    }

    public function setRetourRencontreFa(?string $retour_rencontre_fa): self
    {
        $this->retour_rencontre_fa = $retour_rencontre_fa;

        return $this;
    }

    public function getDateVisite(): ?\DateTimeInterface
    {
        return $this->date_visite;
    }

    public function setDateVisite(?\DateTimeInterface $date_visite): self
    {
        $this->date_visite = $date_visite;

        return $this;
    }

    public function getRetourVisite(): ?string
    {
        return $this->retour_visite;
    }

    public function setRetourVisite(?string $retour_visite): self
    {
        $this->retour_visite = $retour_visite;

        return $this;
    }

    public function getDateAdoption(): ?\DateTimeInterface
    {
        return $this->date_adoption;
    }

    public function setDateAdoption(?\DateTimeInterface $date_adoption): self
    {
        $this->date_adoption = $date_adoption;

        return $this;
    }

    public function getDateDepart(): ?\DateTimeInterface
    {
        return $this->date_depart;
    }

    public function setDateDepart(?\DateTimeInterface $date_depart): self
    {
        $this->date_depart = $date_depart;

        return $this;
    }

    public function getRemarque(): ?string
    {
        return $this->remarque;
    }

    public function setRemarque(?string $remarque): self
    {
        $this->remarque = $remarque;

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

    public function getAdoptant(): ?Adoptant
    {
        return $this->adoptant;
    }

    public function setAdoptant(?Adoptant $adoptant): self
    {
        $this->adoptant = $adoptant;

        return $this;
    }


    public function getAnimauxProposes(): ?string
    {
        return $this->animaux_proposes;
    }

    public function setAnimauxProposes(?string $animaux_proposes): self
    {
        $this->animaux_proposes = $animaux_proposes;

        return $this;
    }

 

    /**
     * @return Collection<int, User>
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
            $user->addAdoption($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->removeElement($user)) {
            $user->removeAdoption($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Animal>
     */
    public function getAnimal(): Collection
    {
        return $this->animal;
    }

    public function addAnimal(Animal $animal): self
    {
        if (!$this->animal->contains($animal)) {
            $this->animal[] = $animal;
            $animal->setAdoption($this);
        }

        return $this;
    }

    public function removeAnimal(Animal $animal): self
    {
        if ($this->animal->removeElement($animal)) {
            // set the owning side to null (unless already changed)
            if ($animal->getAdoption() === $this) {
                $animal->setAdoption(null);
            }
        }

        return $this;
    }
}
