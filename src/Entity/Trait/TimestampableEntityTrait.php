<?php declare(strict_types=1);
/**
 * Created 2023-11-16 10:18:58
 * Author rkwadriga
 */

namespace App\Entity\Trait;

use DateTime;
use DateTimeImmutable;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

trait TimestampableEntityTrait
{
    #[ORM\Column(type: Types::DATETIME_IMMUTABLE)]
    protected ?DateTimeImmutable $createdAt = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    protected ?DateTime $updatedAt = null;

    public function setCreatedAt(DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getCreatedAt(): ?DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setUpdatedAt(DateTime $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getUpdatedAt(): ?DateTime
    {
        return $this->updatedAt;
    }

    #[ORM\PrePersist]
    public function onCreate(): void
    {
        $this->setCreatedAt(new DateTimeImmutable());
    }

    #[ORM\PreUpdate]
    public function onUpdate(): void
    {
        $this->setUpdatedAt(new DateTime());
    }
}