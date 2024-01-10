<?php

namespace App\Entity;

use App\Repository\UserPlantRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserPlantRepository::class)]
class UserPlant
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $adresse = null;

    #[ORM\ManyToOne(inversedBy: 'userPlants')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $idUser = null;

    #[ORM\ManyToOne(inversedBy: 'botanistePlants')]
    private ?User $idBotaniste = null;

    #[ORM\ManyToOne(inversedBy: 'userPlants')]
    private ?Plante $idPlant = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): static
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getIdUser(): ?User
    {
        return $this->idUser;
    }

    public function setIdUser(?User $idUser): static
    {
        $this->idUser = $idUser;

        return $this;
    }

    public function getIdBotaniste(): ?User
    {
        return $this->idBotaniste;
    }

    public function setIdBotaniste(?User $idBotaniste): static
    {
        $this->idBotaniste = $idBotaniste;

        return $this;
    }

    public function getIdPlant(): ?Plante
    {
        return $this->idPlant;
    }

    public function setIdPlant(?Plante $idPlant): static
    {
        $this->idPlant = $idPlant;

        return $this;
    }
}
