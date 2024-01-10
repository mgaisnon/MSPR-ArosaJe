<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    private ?string $email = null;

    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $prenom = null;

    #[ORM\Column(length: 255)]
    private ?string $adresse = null;

    #[ORM\Column]
    private ?int $telephone = null;

    #[ORM\OneToMany(mappedBy: 'idUser', targetEntity: UserPlant::class)]
    private Collection $userPlants;

    #[ORM\OneToMany(mappedBy: 'idBotaniste', targetEntity: UserPlant::class)]
    private Collection $botanistePlants;

    public function __construct()
    {
        $this->userPlants = new ArrayCollection();
        $this->botanistePlants = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
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

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): static
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getTelephone(): ?int
    {
        return $this->telephone;
    }

    public function setTelephone(int $telephone): static
    {
        $this->telephone = $telephone;

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
            $userPlant->setIdUser($this);
        }

        return $this;
    }

    public function removeUserPlant(UserPlant $userPlant): static
    {
        if ($this->userPlants->removeElement($userPlant)) {
            // set the owning side to null (unless already changed)
            if ($userPlant->getIdUser() === $this) {
                $userPlant->setIdUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, UserPlant>
     */
    public function getBotanistePlants(): Collection
    {
        return $this->botanistePlants;
    }

    public function addBotanistePlant(UserPlant $botanistePlant): static
    {
        if (!$this->botanistePlants->contains($botanistePlant)) {
            $this->botanistePlants->add($botanistePlant);
            $botanistePlant->setIdBotaniste($this);
        }

        return $this;
    }

    public function removeBotanistePlant(UserPlant $botanistePlant): static
    {
        if ($this->botanistePlants->removeElement($botanistePlant)) {
            // set the owning side to null (unless already changed)
            if ($botanistePlant->getIdBotaniste() === $this) {
                $botanistePlant->setIdBotaniste(null);
            }
        }

        return $this;
    }
}
