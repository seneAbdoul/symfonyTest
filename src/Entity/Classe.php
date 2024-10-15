<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\ClasseRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

#[ORM\Entity(repositoryClass: ClasseRepository::class)]
#[UniqueEntity('libelle')]
class Classe
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 25)]
    #[Assert\Length(min: 2, max: 25)]
    private ?string $libelle = null;

    #[ORM\ManyToOne(inversedBy: 'classes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Filiere $filiere = null;

    #[ORM\OneToMany(targetEntity: ClasseProfesseur::class, mappedBy: 'classe')]
    private Collection $yes;

    #[ORM\OneToMany(targetEntity: Inscription::class, mappedBy: 'classe')]
    private Collection $inscriptions;

    #[ORM\ManyToOne(inversedBy: 'classes')]
    private ?Niveau $niveau = null;

    #[ORM\ManyToMany(targetEntity: Planification::class, mappedBy: 'classes')]
    private Collection $planifications;

    #[ORM\OneToMany(targetEntity: ClassePlanification::class, mappedBy: 'classe')]
    private Collection $classePlanifications;

    #[ORM\ManyToMany(targetEntity: Examen::class, mappedBy: 'classes')]
    private Collection $examens;


    public function __construct()
    {
        $this->yes = new ArrayCollection();
        $this->inscriptions = new ArrayCollection();
        $this->planifications = new ArrayCollection();
        $this->classePlanifications = new ArrayCollection();
        $this->examens = new ArrayCollection();

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

    /**
     * @return Collection<int, Professeur>
     */

    /**
     * @return Collection<int, self>
     */

    /**
     * @return Collection<int, ClasseProfesseur>
     */
    public function getYes(): Collection
    {
        return $this->yes;
    }

    public function addYe(ClasseProfesseur $ye): static
    {
        if (!$this->yes->contains($ye)) {
            $this->yes->add($ye);
            $ye->setClasse($this);
        }

        return $this;
    }

    public function removeYe(ClasseProfesseur $ye): static
    {
        if ($this->yes->removeElement($ye)) {
            // set the owning side to null (unless already changed)
            if ($ye->getClasse() === $this) {
                $ye->setClasse(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Inscription>
     */
    public function getInscriptions(): Collection
    {
        return $this->inscriptions;
    }

    public function addInscription(Inscription $inscription): static
    {
        if (!$this->inscriptions->contains($inscription)) {
            $this->inscriptions->add($inscription);
            $inscription->setClasse($this);
        }

        return $this;
    }

    public function removeInscription(Inscription $inscription): static
    {
        if ($this->inscriptions->removeElement($inscription)) {
            // set the owning side to null (unless already changed)
            if ($inscription->getClasse() === $this) {
                $inscription->setClasse(null);
            }
        }

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
            $planification->addClass($this);
        }

        return $this;
    }

    public function removePlanification(Planification $planification): static
    {
        if ($this->planifications->removeElement($planification)) {
            $planification->removeClass($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, ClassePlanification>
     */
    public function getClassePlanifications(): Collection
    {
        return $this->classePlanifications;
    }

    public function addClassePlanification(ClassePlanification $classePlanification): static
    {
        if (!$this->classePlanifications->contains($classePlanification)) {
            $this->classePlanifications->add($classePlanification);
            $classePlanification->setClasse($this);
        }

        return $this;
    }

    public function removeClassePlanification(ClassePlanification $classePlanification): static
    {
        if ($this->classePlanifications->removeElement($classePlanification)) {
            // set the owning side to null (unless already changed)
            if ($classePlanification->getClasse() === $this) {
                $classePlanification->setClasse(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Examen>
     */
    public function getExamens(): Collection
    {
        return $this->examens;
    }

    public function addExamen(Examen $examen): static
    {
        if (!$this->examens->contains($examen)) {
            $this->examens->add($examen);
            $examen->addClass($this);
        }

        return $this;
    }

    public function removeExamen(Examen $examen): static
    {
        if ($this->examens->removeElement($examen)) {
            $examen->removeClass($this);
        }

        return $this;
    }



}
