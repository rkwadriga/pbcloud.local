<?php declare(strict_types=1);
/**
 * Created 2023-11-17 16:49:17
 * Author rkwadriga
 */

namespace App\State\Auth;

use ApiPlatform\Metadata;
use ApiPlatform\State\ProviderInterface;
use App\ApiResource\AuthProvidersDto;
use App\Components\Auth\AuthService;
use Symfony\Component\Asset\Exception\LogicException;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use Symfony\Component\HttpFoundation\Request;

class AuthProvidersDtoStateProvider implements ProviderInterface
{
    public function __construct(
        private readonly AuthService $authService
    ) {}

    public function provide(Metadata\Operation $operation, array $uriVariables = [], array $context = []): object|array|null
    {
        if (!($operation instanceof Metadata\Get)) {
            return null;
        }

        /** @var Request $request */
        $request = $context['request'];

        $dto = $request->attributes->get('data');
        if (!($dto instanceof AuthProvidersDto)) {
            throw new LogicException('Missed Deserializer for content type "application/x-www-form-urlencoded"');
        }

        if ($dto->username === null) {
            throw new BadRequestException('Required param "username" is missed');
        }

        return $this->authService->getAuthOptions($dto);
    }
}