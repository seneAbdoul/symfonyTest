<?php

namespace App\Entity;

use App\Repository\ProfesseurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProfesseurRepository::class)]
class Professeur extends User
{
    #[ORM\Column(length: 25)]
    private ?string $grade = null;

    #[ORM\Column(length: 30)]
    private ?string $Cni = null;

    #[ORM\OneToMany(targetEntity: ClasseProfesseur::class, mappedBy: 'professeur')]
    private Collection $classeProfesseurs;

    #[ORM\OneToMany(targetEntity: Module::class, mappedBy: 'professeur')]
    private Collection $modules;


    public function __construct()
    {
        $this->classeProfesseurs = new ArrayCollection();
        $this->modules = new ArrayCollection();
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
     * @return Collection<int, Module>
     */
    public function getModules(): Collection
    {
        return $this->modules;
    }

    public function addModule(Module $module): static
    {
        if (!$this->modules->contains($module)) {
            $this->modules->add($module);
            $module->setProfesseur($this);
        }

        return $this;
    }

    public function removeModule(Module $module): static
    {
        if ($this->modules->removeElement($module)) {
            // set the owning side to null (unless already changed)
            if ($module->getProfesseur() === $this) {
                $module->setProfesseur(null);
            }
        }

        return $this;
    }



}
