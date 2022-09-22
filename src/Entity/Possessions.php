<?php

namespace App\Entity;

use App\Repository\PossessionsRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\ORM\Mapping\JoinColumn;

#[ORM\Entity(repositoryClass: PossessionsRepository::class)]
class Possessions
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]

    #[Groups(['show_users', 'add_product'])]
    private ?int $id = null;

    #[ORM\Column(length: 40)]
  
    #[Groups(['show_users', 'add_product'])]
    private ?string $name = null;

    #[ORM\Column]
   
    #[Groups(['show_users', 'add_product'])]
    private ?float $price = null;

    #[ORM\Column(length: 40)]
    #[Groups(['show_users', 'show_products', 'add_product'])]
    private ?string $type = null;

    #[ORM\ManyToOne(inversedBy: 'product')]
    #[Groups(['add_product'])]
    #[JoinColumn(onDelete: "CASCADE")]
    private ?User $user = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }
}
