<?php

namespace App\Entity;

use App\Repository\AbsenceRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: AbsenceRepository::class)]
class Absence
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    #[Assert\NotNull()]
    private ?\DateTimeImmutable $dateAbsence = null;

    #[ORM\ManyToOne(inversedBy: 'absences')]
    private ?Etudiant $etudiant = null;

    #[ORM\ManyToOne(inversedBy: 'absences')]
    private ?Cours $cour = null;


    public function __construct()
    {
        $this->dateAbsence = new \DateTimeImmutable;
    }
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateAbsence(): ?\DateTimeImmutable
    {
        return $this->dateAbsence;
    }

    public function setDateAbsence(\DateTimeImmutable $dateAbsence): static
    {
        $this->dateAbsence = $dateAbsence;

        return $this;
    }

    public function getEtudiant(): ?Etudiant
    {
        return $this->etudiant;
    }

    public function setEtudiant(?Etudiant $etudiant): static
    {
        $this->etudiant = $etudiant;

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
}
