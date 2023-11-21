<?php declare(strict_types=1);
/**
 * Created 2023-11-21 08:54:02
 * Author rkwadriga
 */

namespace App\Components\Auth;

use App\Components\AbstractComponent;
use App\Constants\TokenPrefixes;
use App\Entity\Enum\TokenTypeEnum;
use App\Entity\Token;
use App\Entity\User;
use DateTime;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;

class TokenGenerator extends AbstractComponent
{
    public function __construct(
        private readonly string $lifetime,
        private readonly EntityManagerInterface $entityManager
    ) {}

    public function generateUserToken(User $user): Token
    {
        $token = new Token();
        $token
            ->setOwner($user)
            ->setType(TokenTypeEnum::USER)
        ;

        $token
            ->setAccessToken($this->generateHash($token))
            ->setRefreshToken($this->generateHash($token))
            ->setCreatedAt(new DateTimeImmutable())
            ->setExpiredAt(new DateTime('+' . $this->lifetime));
        ;

        $this->entityManager->persist($token);
        $this->entityManager->flush();

        return $token;
    }

    public function getTokenString(Token $token, string $hash): string
    {
        return base64_encode(sprintf('%s:%s', $this->getPayloadString($token), $hash));
    }

    private function generateHash(Token $token): string
    {
        return md5(sprintf('%s:%s', $this->getPayloadString($token), uniqid()));
    }

    private function getPayloadString(Token $token): string
    {
        $prefix = match ($token->getType()) {
            TokenTypeEnum::USER => TokenPrefixes::USER,
            TokenTypeEnum::PROVIDER => TokenPrefixes::PROVIDER
        };

        $id = $token->getOwner() !== null ? $token->getOwner()->getId() : $token->getProvider()->getId();

        return sprintf('%s:%s', $prefix, $id);
    }
}