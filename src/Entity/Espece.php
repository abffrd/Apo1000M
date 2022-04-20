<?php

namespace App\Entity;

use App\Repository\EspeceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EspeceRepository::class)
 */
class Espece
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
    private $type;

    /**
     * @ORM\ManyToMany(targetEntity="FamilleAccueil", mappedBy="especes")
     * @ORM\JoinTable(name="famille_accueil_espece")
     */
    private $familleAccueils;

    /**
     * @ORM\OneToMany(targetEntity=Animal::class, mappedBy="espece")
     */
    private $animaux;

    public function __construct()
    {
        $this->familleAccueils = new ArrayCollection();
        $this->animaux = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return Collection<int, FamilleAccueil>
     */
    public function getFamilleAccueils(): Collection
    {
        return $this->familleAccueils;
    }

    public function addFamilleAccueil(FamilleAccueil $familleAccueil): self
    {
        if (!$this->familleAccueils->contains($familleAccueil)) {
            $this->familleAccueils[] = $familleAccueil;
            $familleAccueil->addEspece($this);
        }

        return $this;
    }

    public function removeFamilleAccueil(FamilleAccueil $familleAccueil): self
    {
        if ($this->familleAccueils->removeElement($familleAccueil)) {
            $familleAccueil->removeEspece($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Animal>
     */
    public function getAnimaux(): Collection
    {
        return $this->animaux;
    }

    public function addAnimaux(Animal $animaux): self
    {
        if (!$this->animaux->contains($animaux)) {
            $this->animaux[] = $animaux;
            $animaux->setEspece($this);
        }

        return $this;
    }

    public function removeAnimaux(Animal $animaux): self
    {
        if ($this->animaux->removeElement($animaux)) {
            // set the owning side to null (unless already changed)
            if ($animaux->getEspece() === $this) {
                $animaux->setEspece(null);
            }
        }

        return $this;
    }
}
