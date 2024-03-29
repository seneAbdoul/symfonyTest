<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\SeanceRepository;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

#[ORM\Entity(repositoryClass: SeanceRepository::class)]
class Seance
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    #[Assert\NotNull()]
    #[Assert\GreaterThan('today')]
    private ?\DateTimeImmutable $date = null;

    #[ORM\Column(type: Types::TIME_IMMUTABLE)]
    #[Assert\NotNull()]
    #[Assert\NotEqualTo(
        value: '08:00:00'
    )]
    private ?\DateTimeImmutable $heure_debut = null;

    #[ORM\Column(type: Types::TIME_IMMUTABLE)]
    #[Assert\NotNull()]
    private ?\DateTimeImmutable $heure_fin = null;

    #[ORM\Column(length: 25)]
    private ?string $etat = null;

    #[ORM\ManyToOne(inversedBy: 'seances')]
    private ?ClassePlanification $classePlanification = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeImmutable
    {
        return $this->date;
    }

    public function setDate(\DateTimeImmutable $date): static
    {
        $this->date = $date;

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

    public function getEtat(): ?string
    {
        return $this->etat;
    }

    public function setEtat(string $etat): static
    {
        $this->etat = $etat;

        return $this;
    }

    public function getClassePlanification(): ?ClassePlanification
    {
        return $this->classePlanification;
    }

    public function setClassePlanification(?ClassePlanification $classePlanification): static
    {
        $this->classePlanification = $classePlanification;

        return $this;
    }

}
