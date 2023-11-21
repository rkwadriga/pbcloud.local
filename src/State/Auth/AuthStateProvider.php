<?php declare(strict_types=1);
/**
 * Created 2023-11-17 16:49:17
 * Author rkwadriga
 */

namespace App\State\Auth;

use ApiPlatform\Metadata;
use ApiPlatform\State\ProviderInterface;
use App\Components\Auth\AuthService;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use Symfony\Component\HttpFoundation\Request;

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
            if (!isset($context['filters']) || !isset($context['filters']['username'])) {
                throw new BadRequestException('Required param "username" is missed');
            }

            return $this->authService->getAuthOptions($operation->getClass(), $context['filters']);
        } elseif ($operation instanceof Metadata\Post) {
            $username = $request->request->get('username');
            $password = $request->request->get('password');
            if (!$username || !$password) {
                throw new BadRequestException('Params "username" and "password" are required');
            }

            $attributes = array_merge($uriVariables, ['username' => $username, 'password' => $password]);

            /** @TODO Fix bug Deserialization for the format "form_urlencoded" is not supported */
            return $this->authService->login($operation->getClass(), $attributes);
        }

        return null;
    }
}