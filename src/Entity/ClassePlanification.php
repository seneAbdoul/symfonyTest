<?php

namespace App\Entity;

use App\Repository\ClassePlanificationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Validator\Constraints as Assert;


#[ORM\Entity(repositoryClass: ClassePlanificationRepository::class)]
class ClassePlanification
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    #[Assert\NotNull()]
    private ?int $nombre_heure = null;

    #[ORM\Column]
    #[Assert\NotNull()]
    private ?int $heure_fait = null;

    #[ORM\ManyToOne(inversedBy: 'classePlanifications')]
    private ?Classe $classe = null;

    #[ORM\ManyToOne(inversedBy: 'classePlanifications')]
    private ?Planification $planification = null;

    #[ORM\OneToMany(targetEntity: Seance::class, mappedBy: 'classePlanification')]
    private Collection $seances;

    public function __construct()
    {
        $this->seances = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
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

    public function getHeureFait(): ?int
    {
        return $this->heure_fait;
    }

    public function setHeureFait(int $heure_fait): static
    {
        $this->heure_fait = $heure_fait;

        return $this;
    }

    public function getClasse(): ?Classe
    {
        return $this->classe;
    }

    public function setClasse(?Classe $classe): static
    {
        $this->classe = $classe;

        return $this;
    }

    public function getPlanification(): ?Planification
    {
        return $this->planification;
    }

    public function setPlanification(?Planification $planification): static
    {
        $this->planification = $planification;

        return $this;
    }

    /**
     * @return Collection<int, Seance>
     */
    public function getSeances(): Collection
    {
        return $this->seances;
    }

    public function addSeance(Seance $seance): static
    {
        if (!$this->seances->contains($seance)) {
            $this->seances->add($seance);
            $seance->setClassePlanification($this);
        }

        return $this;
    }

    public function removeSeance(Seance $seance): static
    {
        if ($this->seances->removeElement($seance)) {
            // set the owning side to null (unless already changed)
            if ($seance->getClassePlanification() === $this) {
                $seance->setClassePlanification(null);
            }
        }

        return $this;
    }

}
