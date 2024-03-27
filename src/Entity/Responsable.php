<?php

namespace App\Entity;

use App\Repository\ResponsableRepository;
use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ResponsableRepository::class)]
class Responsable extends User
{
    #[ORM\Column(length: 25)]
    #[Assert\Length(min: 2, max: 25)]
    #[Assert\NotBlank()]
    private ?string $acces = null;

    public function getAcces(): ?string
    {
        return $this->acces;
    }

    public function setAcces(string $acces): static
    {
        $this->acces = $acces;

        return $this;
    }
}
