<?php

namespace App\Entity;

use App\Repository\CoursRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: CoursRepository::class)]
class Cours
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 25)]
    #[Assert\Length(min: 2, max: 25)]
    private ?string $libelle = null;

    #[ORM\OneToMany(targetEntity: Absence::class, mappedBy: 'cour')]
    private Collection $absences;

    #[ORM\OneToMany(targetEntity: Planification::class, mappedBy: 'cours')]
    private Collection $planifications;

    #[ORM\Column(length: 25)]
    private ?string $etat = null;

  

    #[ORM\ManyToOne(inversedBy: 'cours')]

    public function __construct()
    {
        $this->absences = new ArrayCollection();
        $this->planifications = new ArrayCollection();
     
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): static
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * @return Collection<int, Absence>
     */
    public function getAbsences(): Collection
    {
        return $this->absences;
    }

    public function addAbsence(Absence $absence): static
    {
        if (!$this->absences->contains($absence)){
            $this->absences->add($absence);
            $absence->setCour($this);
        }

        return $this;
    }

    public function removeAbsence(Absence $absence): static
    {
        if ($this->absences->removeElement($absence)) {
            // set the owning side to null (unless already changed)
            if ($absence->getCour() === $this) {
                $absence->setCour(null);
            }
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
            $planification->setCours($this);
        }

        return $this;
    }

    public function removePlanification(Planification $planification): static
    {
        if ($this->planifications->removeElement($planification)) {
            // set the owning side to null (unless already changed)
            if ($planification->getCours() === $this) {
                $planification->setCours(null);
            }
        }

        return $this;
    }

    public function getEtat(): ?string
    {
        return $this->etat;
    }

    public function setEtat(string $etat): static
    {
        $this->etat = $etat;
        
        return $this;
    }

}
