<?php

namespace App\Entity;

use App\Repository\PlanificationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: PlanificationRepository::class)]
class Planification
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 25)]
    #[Assert\Length(min: 2, max: 25)]
    private ?string $semestre = null;

    #[ORM\ManyToOne(inversedBy: 'planifications')]
    private ?Module $module = null;

    #[ORM\ManyToOne(inversedBy: 'planifications')]
    private ?Professeur $professeur = null;

    #[ORM\ManyToMany(targetEntity: Classe::class, inversedBy: 'planifications')]
    private Collection $classes;

    #[ORM\OneToMany(targetEntity: ClassePlanification::class, mappedBy: 'planification')]
    private Collection $classePlanifications;

    #[ORM\ManyToOne(inversedBy: 'planifications')]
    private ?Cours $cour = null;

    #[ORM\Column]
    private ?int $nombre_heure = null;


    public function __construct()
    {
        $this->classes = new ArrayCollection();
        $this->classePlanifications = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSemestre(): ?string
    {
        return $this->semestre;
    }

    public function setSemestre(string $semestre): static
    {
        $this->semestre = $semestre;

        return $this;
    }

    public function getModule(): ?Module
    {
        return $this->module;
    }

    public function setModule(?Module $module): static
    {
        $this->module = $module;

        return $this;
    }

    public function getProfesseur(): ?Professeur
    {
        return $this->professeur;
    }

    public function setProfesseur(?Professeur $professeur): static
    {
        $this->professeur = $professeur;

        return $this;
    }

    /**
     * @return Collection<int, Classe>
     */
    public function getClasses(): Collection
    {
        return $this->classes;
    }

    public function addClass(Classe $class): static
    {
        if (!$this->classes->contains($class)) {
            $this->classes->add($class);
        }

        return $this;
    }

    public function removeClass(Classe $class): static
    {
        $this->classes->removeElement($class);

        return $this;
    }

    /**
     * @return Collection<int, ClassePlanification>
     */
    public function getClassePlanifications(): Collection
    {
        return $this->classePlanifications;
    }

    public function addClassePlanification(ClassePlanification $classePlanification): static
    {
        if (!$this->classePlanifications->contains($classePlanification)) {
            $this->classePlanifications->add($classePlanification);
            $classePlanification->setPlanification($this);
        }

        return $this;
    }

    public function removeClassePlanification(ClassePlanification $classePlanification): static
    {
        if ($this->classePlanifications->removeElement($classePlanification)) {
            // set the owning side to null (unless already changed)
            if ($classePlanification->getPlanification() === $this) {
                $classePlanification->setPlanification(null);
            }
        }

        return $this;
    }

    public function getCour(): ?Cours
    {
        return $this->cour;
    }

    public function setCour(?Cours $cour): static
    {
        $this->cour = $cour;

        return $this;
    }

    public function getNombreHeure(): ?int
    {
        return $this->nombre_heure;
    }

    public function setNombreHeure(int $nombre_heure): static
    {
        $this->nombre_heure = $nombre_heure;

        return $this;
    }

}
