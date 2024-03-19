<?php

namespace App\Entity;

use App\Repository\AnneeScolaireRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: AnneeScolaireRepository::class)]
class AnneeScolaire
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 25)]
    #[Assert\NotBlank()]
    private ?string $libelle = null;

    #[ORM\Column(length: 25)]
    #[Assert\Length(min: 2, max: 25)]
    #[Assert\NotBlank()]
    private ?string $etat = null;

    #[ORM\OneToMany(targetEntity: ClasseProfesseur::class, mappedBy: 'anneeScolaire')]
    private Collection $classeProfesseurs;

    public function __construct()
    {
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

    public function getEtat(): ?string
    {
        return $this->etat;
    }

    public function setEtat(string $etat): static
    {
        $this->etat = $etat;

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
            $classeProfesseur->setAnneeScolaire($this);
        }

        return $this;
    }

    public function removeClasseProfesseur(ClasseProfesseur $classeProfesseur): static
    {
        if ($this->classeProfesseurs->removeElement($classeProfesseur)) {
            // set the owning side to null (unless already changed)
            if ($classeProfesseur->getAnneeScolaire() === $this) {
                $classeProfesseur->setAnneeScolaire(null);
            }
        }

        return $this;
    }
}
