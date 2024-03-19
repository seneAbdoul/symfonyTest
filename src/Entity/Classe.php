<?php

namespace App\Entity;

use App\Repository\ClasseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ClasseRepository::class)]
class Classe
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 25)]
    #[Assert\Length(min: 2, max: 25)]
    #[Assert\NotBlank()]
    private ?string $libelle = null;

    #[ORM\ManyToOne(inversedBy: 'classes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Filiere $filiere = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Niveau $niveau = null;

    #[ORM\ManyToMany(targetEntity: Professeur::class, mappedBy: 'classes')]
    private Collection $yes;

    #[ORM\ManyToOne(targetEntity: self::class, inversedBy: 'classeProfesseurs')]
    private ?self $classe = null;

    #[ORM\OneToMany(targetEntity: self::class, mappedBy: 'classe')]
    private Collection $classeProfesseurs;

    public function __construct()
    {
        $this->yes = new ArrayCollection();
        $this->classeProfesseurs = new ArrayCollection();
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

    public function getFiliere(): ?Filiere
    {
        return $this->filiere;
    }

    public function setFiliere(?Filiere $filiere): static
    {
        $this->filiere = $filiere;

        return $this;
    }

    public function getNiveau(): ?Niveau
    {
        return $this->niveau;
    }

    public function setNiveau(?Niveau $niveau): static
    {
        $this->niveau = $niveau;

        return $this;
    }

    /**
     * @return Collection<int, Professeur>
     */
    public function getYes(): Collection
    {
        return $this->yes;
    }


    public function getClasse(): ?self
    {
        return $this->classe;
    }

    public function setClasse(?self $classe): static
    {
        $this->classe = $classe;

        return $this;
    }

    /**
     * @return Collection<int, self>
     */
    public function getClasseProfesseurs(): Collection
    {
        return $this->classeProfesseurs;
    }

    public function addClasseProfesseur(self $classeProfesseur): static
    {
        if (!$this->classeProfesseurs->contains($classeProfesseur)) {
            $this->classeProfesseurs->add($classeProfesseur);
            $classeProfesseur->setClasse($this);
        }

        return $this;
    }

    public function removeClasseProfesseur(self $classeProfesseur): static
    {
        if ($this->classeProfesseurs->removeElement($classeProfesseur)) {
            // set the owning side to null (unless already changed)
            if ($classeProfesseur->getClasse() === $this) {
                $classeProfesseur->setClasse(null);
            }
        }

        return $this;
    }
}
