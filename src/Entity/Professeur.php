<?php

namespace App\Entity;

use App\Repository\ProfesseurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ProfesseurRepository::class)]
class Professeur extends User
{
    #[ORM\Column(length: 25)]
    #[Assert\Length(min: 2, max: 25)]
    
    private ?string $grade = null;

    #[ORM\Column(length: 30)]
    #[Assert\Length(min: 2, max: 30)]
    
    private ?string $Cni = null;

    #[ORM\OneToMany(targetEntity: ClasseProfesseur::class, mappedBy: 'professeur')]
    private Collection $classeProfesseurs;

    #[ORM\OneToMany(targetEntity: Planification::class, mappedBy: 'professeur')]
    private Collection $planifications;

    public function __construct()
    {
        parent::__construct();
        $this->planifications = new ArrayCollection();
    }

    public function getGrade(): ?string
    {
        return $this->grade;
    }

    public function setGrade(string $grade): static
    {
        $this->grade = $grade;

        return $this;
    }

    public function getCni(): ?string
    {
        return $this->Cni;
    }

    public function setCni(string $Cni): static
    {
        $this->Cni = $Cni;

        return $this;
    }

    /**
     * @return Collection<int, ClasseProfesseur>
     */
    public function getClasseProfesseurs(): Collection
    {
        return $this->classeProfesseurs;
    }


    public function addClasseProfesseur(ClasseProfesseur $classeProfesseur): static
    {
        if (!$this->classeProfesseurs->contains($classeProfesseur)) {
            $this->classeProfesseurs->add($classeProfesseur);
            $classeProfesseur->setProfesseur($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Planification>
     */
    public function getPlanifications(): Collection
    {
        return $this->planifications;
    }

    public function addPlanification(Planification $planification): static
    {
        if (!$this->planifications->contains($planification)) {
            $this->planifications->add($planification);
            $planification->setProfesseur($this);
        }

        return $this;
    }

    public function removePlanification(Planification $planification): static
    {
        if ($this->planifications->removeElement($planification)) {
            // set the owning side to null (unless already changed)
            if ($planification->getProfesseur() === $this) {
                $planification->setProfesseur(null);
            }
        }

        return $this;
    }
}
