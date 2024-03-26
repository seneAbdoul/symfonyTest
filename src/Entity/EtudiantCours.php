<?php

namespace App\Entity;

use App\Repository\EtudiantCoursRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EtudiantCoursRepository::class)]
class EtudiantCours
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'etudiantCours')]
    private ?Etudiant $etudiant = null;

    #[ORM\ManyToOne(inversedBy: 'etudiantCours')]
    private ?Cours $cour = null;

    public function getId(): ?int
    {
        return $this->id;
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
