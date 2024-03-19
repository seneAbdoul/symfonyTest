<?php

namespace App\Entity;

use App\Repository\ProfesseurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ProfesseurRepository::class)]
class Professeur
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 25)]
    #[Assert\Length(min: 2, max: 25)]
    #[Assert\NotBlank()]
    private ?string $nom = null;

    #[ORM\Column(length: 25)]
    #[Assert\Length(min: 2, max: 25)]
    #[Assert\NotBlank()]
    private ?string $prenom = null;

    #[ORM\Column(length: 25)]
    #[Assert\NotBlank()]
    private ?string $grade = null;

    #[ORM\OneToMany(targetEntity: ClasseProfesseur::class, mappedBy: 'professeur')]
    private Collection $classeProfesseurs;

    public function __construct()
    {
        $this->classeProfesseurs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): static
    {
        $this->prenom = $prenom;

        return $this;
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

    public function removeClasseProfesseur(ClasseProfesseur $classeProfesseur): static
    {
        if ($this->classeProfesseurs->removeElement($classeProfesseur)) {
            // set the owning side to null (unless already changed)
            if ($classeProfesseur->getProfesseur() === $this) {
                $classeProfesseur->setProfesseur(null);
            }
        }

        return $this;
    }
}
