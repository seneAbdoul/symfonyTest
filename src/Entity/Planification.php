<?php

namespace App\Entity;

use App\Repository\PlanificationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: PlanificationRepository::class)]
class Planification
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $datePlanification = null;

    #[ORM\Column(type: Types::TIME_IMMUTABLE ,nullable: true)]
    private ?\DateTimeImmutable $heure_debut = null;

    #[ORM\Column(type: Types::TIME_IMMUTABLE,nullable: true)]
    private ?\DateTimeImmutable $heure_fin = null;

    #[ORM\Column]
    #[Assert\NotNull()]
    private ?int $nombre_heure = null;

    #[ORM\Column(length: 25)]
    #[Assert\Length(min: 2, max: 25)]
    #[Assert\NotBlank()]
    private ?string $semestre = null;


    #[ORM\ManyToOne(inversedBy: 'planifications')]
    private ?Module $module = null;

    #[ORM\ManyToOne(inversedBy: 'planifications')]
    private ?Professeur $professeur = null;

    #[ORM\ManyToMany(targetEntity: Classe::class, inversedBy: 'planifications')]
    private Collection $classes;

    #[ORM\Column]
    private ?int $heure_fait = null;

   

    
    public function __construct()
    {
        $this->datePlanification = new \DateTimeImmutable;
        $this->heure_debut = new \DateTimeImmutable;
        $this->heure_fin = new \DateTimeImmutable;
        $this->classes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDatePlanification(): ?\DateTimeImmutable
    {
        return $this->datePlanification;
    }

    public function setDatePlanification(\DateTimeImmutable $datePlanification): static
    {
        $this->datePlanification = $datePlanification;

        return $this;
    }

    public function getHeureDebut(): ?\DateTimeImmutable
    {
        return $this->heure_debut;
    }

    public function setHeureDebut(\DateTimeImmutable $heure_debut): static
    {
        $this->heure_debut = $heure_debut;

        return $this;
    }

    public function getHeureFin(): ?\DateTimeImmutable
    {
        return $this->heure_fin;
    }

    public function setHeureFin(\DateTimeImmutable $heure_fin): static
    {
        $this->heure_fin = $heure_fin;

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

    public function getHeureFait(): ?int
    {
        return $this->heure_fait;
    }

    public function setHeureFait(int $heure_fait): static
    {
        $this->heure_fait = $heure_fait;

        return $this;
    }

}
