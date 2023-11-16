<?php

namespace App\Entity;

use App\Entity\Enum\ProviderTypeEnum;
use App\Entity\Enum\IsActiveStatusEnum;
use App\Entity\Trait\TimestampableEntityTrait;
use App\Repository\ProviderRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProviderRepository::class)]
#[ORM\HasLifecycleCallbacks]
#[ORM\Index(columns: ['alias'], name: 'provider_alias_idx')]
class Provider
{
    use TimestampableEntityTrait;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 64)]
    private ?string $name = null;

    #[ORM\Column(length: 16)]
    private ?string $alias = null;

    #[ORM\Column(length: 16)]
    private ?string $api_key = null;

    #[ORM\Column(length: 64)]
    private ?string $api_secret = null;

    #[ORM\Column(columnDefinition: "provider_type_enum")]
    private ProviderTypeEnum $type = ProviderTypeEnum::PARTNER;

    #[ORM\Column(columnDefinition: "is_active_status_enum")]
    private IsActiveStatusEnum $status = IsActiveStatusEnum::NOT_ACTIVE;

    #[ORM\Column]
    private array $extra = [];

    public function __construct()
    {

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

    public function getAlias(): ?string
    {
        return $this->alias;
    }

    public function setAlias(string $alias): static
    {
        $this->alias = $alias;

        return $this;
    }

    public function getApiKey(): ?string
    {
        return $this->api_key;
    }

    public function setApiKey(string $api_key): static
    {
        $this->api_key = $api_key;

        return $this;
    }

    public function getApiSecret(): ?string
    {
        return $this->api_secret;
    }

    public function setApiSecret(string $api_secret): static
    {
        $this->api_secret = $api_secret;

        return $this;
    }

    public function getType(): ProviderTypeEnum
    {
        return $this->type;
    }

    public function setType(ProviderTypeEnum $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function getStatus(): IsActiveStatusEnum
    {
        return $this->status;
    }

    public function setStatus(IsActiveStatusEnum $status): static
    {
        $this->status = $status;

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
