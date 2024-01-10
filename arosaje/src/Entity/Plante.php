<?php

namespace App\Entity;

use App\Repository\PlanteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PlanteRepository::class)]
class Plante
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $weight = null;

    #[ORM\Column(length: 255)]
    private ?string $species = null;

    #[ORM\OneToMany(mappedBy: 'idPlant', targetEntity: UserPlant::class)]
    private Collection $userPlants;

    public function __construct()
    {
        $this->userPlants = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getWeight(): ?string
    {
        return $this->weight;
    }

    public function setWeight(string $weight): static
    {
        $this->weight = $weight;

        return $this;
    }

    public function getSpecies(): ?string
    {
        return $this->species;
    }

    public function setSpecies(string $species): static
    {
        $this->species = $species;

        return $this;
    }

    /**
     * @return Collection<int, UserPlant>
     */
    public function getUserPlants(): Collection
    {
        return $this->userPlants;
    }

    public function addUserPlant(UserPlant $userPlant): static
    {
        if (!$this->userPlants->contains($userPlant)) {
            $this->userPlants->add($userPlant);
            $userPlant->setIdPlant($this);
        }

        return $this;
    }

    public function removeUserPlant(UserPlant $userPlant): static
    {
        if ($this->userPlants->removeElement($userPlant)) {
            // set the owning side to null (unless already changed)
            if ($userPlant->getIdPlant() === $this) {
                $userPlant->setIdPlant(null);
            }
        }

        return $this;
    }
}
