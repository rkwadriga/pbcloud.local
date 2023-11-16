<?php

namespace App\Entity;

use App\Entity\Trait\TimestampableEntityTrait;
use App\Repository\ShopRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ShopRepository::class)]
class Shop
{
    use TimestampableEntityTrait;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'shops')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Provider $provider = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column]
    private array $extra = [];

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProvider(): ?Provider
    {
        return $this->provider;
    }

    public function setProvider(?Provider $provider): static
    {
        $this->provider = $provider;

        return $this;
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

    public function getExtra(): array
    {
        return $this->extra;
    }

    public function setExtra(array $extra): static
    {
        $this->extra = $extra;

        return $this;
    }
}
