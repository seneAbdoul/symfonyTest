<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\ModuleRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

#[ORM\Entity(repositoryClass: ModuleRepository::class)]
#[UniqueEntity('libelle')]
class Module
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 25)]
    #[Assert\Length(min: 2, max: 25)]
    #[Assert\NotBlank()]
    private ?string $libelle = null;

    #[ORM\OneToMany(targetEntity: Professeur::class, mappedBy: 'module')]
    private Collection $professeurs;

    public function __construct()
    {
        $this->professeurs = new ArrayCollection();
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

    /**
     * @return Collection<int, Professeur>
     */
    public function getProfesseurs(): Collection
    {
        return $this->professeurs;
    }

    public function addProfesseur(Professeur $professeur): static
    {
        if (!$this->professeurs->contains($professeur)) {
            $this->professeurs->add($professeur);
            $professeur->setModule($this);
        }

        return $this;
    }

    public function removeProfesseur(Professeur $professeur): static
    {
        if ($this->professeurs->removeElement($professeur)) {
            // set the owning side to null (unless already changed)
            if ($professeur->getModule() === $this) {
                $professeur->setModule(null);
            }
        }

        return $this;
    }

 



 

}
