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
    #[Assert\NotBlank()]
    private ?string $grade = null;

    #[ORM\Column(length: 30)]
    #[Assert\Length(min: 2, max: 30)]
    #[Assert\NotBlank()]
    private ?string $Cni = null;

    #[ORM\OneToMany(targetEntity: ClasseProfesseur::class, mappedBy: 'professeur')]
    private Collection $classeProfesseurs;

    #[ORM\ManyToOne(inversedBy: 'professeurs')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Module $module = null;

    #[ORM\OneToMany(targetEntity: Cours::class, mappedBy: 'professeur')]
    private Collection $cours;

    public function __construct()
    {
        parent::__construct();
        $this->cours = new ArrayCollection();
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

    public function getModule(): ?Module
    {
        return $this->module;
    }

    public function setModule(?Module $module): static
    {
        $this->module = $module;

        return $this;
    }

    /**
     * @return Collection<int, Cours>
     */
    public function getCours(): Collection
    {
        return $this->cours;
    }

    public function addCour(Cours $cour): static
    {
        if (!$this->cours->contains($cour)) {
            $this->cours->add($cour);
            $cour->setProfesseur($this);
        }

        return $this;
    }

    public function removeCour(Cours $cour): static
    {
        if ($this->cours->removeElement($cour)) {
            // set the owning side to null (unless already changed)
            if ($cour->getProfesseur() === $this) {
                $cour->setProfesseur(null);
            }
        }

        return $this;
    }

}
