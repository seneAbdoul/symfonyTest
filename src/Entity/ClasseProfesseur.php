<?php

namespace App\Entity;

use App\Repository\ClasseProfesseurRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ClasseProfesseurRepository::class)]
class ClasseProfesseur
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'classeProfesseurs')]
    private ?Professeur $professeur = null;

    #[ORM\ManyToOne(inversedBy: 'classeProfesseurs')]
    private ?Classe $classe = null;

    #[ORM\ManyToOne(inversedBy: 'classeProfesseurs')]
    private ?AnneeScolaire $anneeScolaire = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getClasse(): ?Classe
    {
        return $this->classe;
    }

    public function setClasse(?Classe $classe): static
    {
        $this->classe = $classe;

        return $this;
    }

    public function getAnneeScolaire(): ?AnneeScolaire
    {
        return $this->anneeScolaire;
    }

    public function setAnneeScolaire(?AnneeScolaire $anneeScolaire): static
    {
        $this->anneeScolaire = $anneeScolaire;

        return $this;
    }
}
