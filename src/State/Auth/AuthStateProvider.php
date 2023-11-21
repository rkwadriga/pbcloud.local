<?php declare(strict_types=1);
/**
 * Created 2023-11-17 16:49:17
 * Author rkwadriga
 */

namespace App\State\Auth;

use ApiPlatform\Metadata;
use ApiPlatform\State\ProviderInterface;
use App\ApiResource\AuthProvidersDto;
use App\ApiResource\AuthTokenDto;
use App\Components\Auth\AuthService;
use Symfony\Component\Asset\Exception\LogicException;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Encoder\ChainEncoder;

class AuthStateProvider implements ProviderInterface
{
    public function __construct(
        private readonly AuthService $authService
    ) {}

    public function provide(Metadata\Operation $operation, array $uriVariables = [], array $context = []): object|array|null
    {
        /** @var Request $request */
        $request = $context['request'];

        if ($operation instanceof Metadata\Get) {
            $dto = $request->attributes->get('data');
            if (!($dto instanceof AuthProvidersDto)) {
                throw new LogicException('Missed Deserializer for content type "application/x-www-form-urlencoded"');
            }

            if ($dto->username === null) {
                throw new BadRequestException('Required param "username" is missed');
            }

            return $this->authService->getAuthOptions($dto);
        } elseif ($operation instanceof Metadata\Post) {
            $dto = $request->attributes->get('data');
            if (!($dto instanceof AuthTokenDto)) {
                throw new LogicException('Missed Deserializer for content type "application/x-www-form-urlencoded"');
            }

            if ($dto->providerAlias === null) {
                throw new BadRequestException('Required uri-param "providerAlias" is missed');
            }
            if ($dto->username === null || $dto->password === null) {
                throw new BadRequestException('Params "username" and "password" are required');
            }

            return $this->authService->login($dto);
        }

        return null;
    }
}