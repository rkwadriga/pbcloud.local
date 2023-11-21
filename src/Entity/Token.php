<?php

namespace App\Entity;

use App\Entity\Enum\TokenTypeEnum;
use App\Entity\Trait\TimestampableEntityTrait;
use App\Repository\TokenRepository;
use DateTimeInterface;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TokenRepository::class)]
#[ORM\Index(columns: ['access_token'], name: 'token_access_token_idx')]
class Token
{
    use TimestampableEntityTrait;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Provider $provider = null;

    #[ORM\ManyToOne]
    private ?User $owner = null;

    #[ORM\Column(columnDefinition: "token_type_enum NOT NULL")]
    private TokenTypeEnum $type = TokenTypeEnum::USER;

    #[ORM\Column(length: 40)]
    private ?string $access_token = null;

    #[ORM\Column(length: 40)]
    private ?string $refresh_token = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?DateTimeInterface $expired_at = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProvider(): ?Provider
    {
        return $this->provider;
    }

    public function setProvider(Provider $provider): static
    {
        $this->provider = $provider;

        return $this;
    }

    public function getOwner(): ?User
    {
        return $this->owner;
    }

    public function setOwner(?User $owner): static
    {
        $this->owner = $owner;
        $this->setProvider($owner->getProvider());

        return $this;
    }

    public function getType(): TokenTypeEnum
    {
        return $this->type;
    }

    public function setType(TokenTypeEnum $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function getAccessToken(): ?string
    {
        return $this->access_token;
    }

    public function setAccessToken(string $access_token): static
    {
        $this->access_token = $access_token;

        return $this;
    }

    public function getRefreshToken(): ?string
    {
        return $this->refresh_token;
    }

    public function setRefreshToken(string $refresh_token): static
    {
        $this->refresh_token = $refresh_token;

        return $this;
    }

    public function getExpiredAt(): ?DateTimeInterface
    {
        return $this->expired_at;
    }

    public function setExpiredAt(DateTimeInterface $expired_at): static
    {
        $this->expired_at = $expired_at;

        return $this;
    }
}
