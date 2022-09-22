<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: UserRepository::class)]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['show_users', 'add_Possessions'])]
    private int $id;

    #[ORM\Column(length: 40)]
    #[Groups(['show_users'])]
    private string $firstName;

    #[ORM\Column(length: 40)]
    #[Groups(['show_users'])]
    private string $lastName;

    #[ORM\Column(length: 40)]
    #[Groups(['show_users'])]
    private string $email;

    #[ORM\Column(length: 40)]
    #[Groups(['show_users'])]
    private string $address;

    #[ORM\Column(length: 40)]
    #[Groups(['show_users'])]
    private string $tel;

    #[Groups(['show_users'])]
    private int $age;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    #[Groups(['show_users'])]
    private \DateTimeInterface $birthDate;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Possessions::class, orphanRemoval: true)]
    #[Groups(['show_users'])]
    private Collection $possessions;

    public function __construct()
    {
        $this->Possessions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getTel(): ?string
    {
        return $this->tel;
    }

    public function setTel(string $tel): self
    {
        $this->tel = $tel;

        return $this;
    }
    public function getAge(): ?int
    {
        return $this->age;
    }

    public function setAge(int $age): self
    {
        $this->age = $age;

        return $this;
    }

    public function getBirthDate(): ?\DateTimeInterface
    {
        return $this->birthDate;
    }

    public function setBirthDate(\DateTimeInterface $birthDate): self
    {
        $this->birthDate = $birthDate;

        return $this;
    }

    /**
     * @return Collection<int, Possessions>
     */
    public function getPossessions(): Collection
    {
        return $this->possessions;
    }

    public function addPossessions(Possessions $possessions): self
    {
        if (!$this->possessions->contains($possessions)) {
            $this->possessions->add($possessions);
            $possessions->setUser($this);
        }

        return $this;
    }

    public function removePossessions(Possessions $possessions): self
    {
        if ($this->possessions->removeElement($possessions)) {
            // set the owning side to null (unless already changed)
            if ($possessions->getUser() === $this) {
                $possessions->setUser(null);
            }
        }

        return $this;
    }
}
