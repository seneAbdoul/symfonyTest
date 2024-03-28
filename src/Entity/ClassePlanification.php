<?php

namespace App\Entity;

use App\Repository\ClassePlanificationRepository;
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
}
