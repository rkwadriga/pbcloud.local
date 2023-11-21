<?php declare(strict_types=1);
/**
 * Created 2023-11-17 16:56:05
 * Author rkwadriga
 */

namespace App\Components\Auth;

use App\ApiResource\AuthProvidersDto;
use App\ApiResource\AuthTokenDto;
use App\Components\AbstractComponent;
use App\Constants\ProviderAliases;
use App\Dto\DtoFactory;
use App\Repository\ProviderRepository;
use App\Repository\UserRepository;

class AuthService extends AbstractComponent
{
    public function __construct(
        private readonly DtoFactory $dtoFactory,
        private readonly TokenGenerator $tokenGenerator,
        private readonly ProviderRepository $providerRepository,
        private readonly UserRepository $userRepository
    ) {}

    public function getAuthOptions(string $dtoClass, array $attributes): AuthProvidersDto
    {
        /** @var AuthProvidersDto $dto */
        $dto = $this->dtoFactory->create($dtoClass, $attributes);

        $dto->auth_providers = [
            ProviderAliases::DEV24_POCKETBOOK_DE => [
                'name' => 'pocketbook.de',
                'clientID' => $dto->username,
                'loggedBy' => 'facebook|gmail',
                'icon' => 'https://pocketbook.de/media/logo/stores/1/Logo_PocketBook_E-Books-u-E-Reader_green.png',
                'icon_eink' => 'https://pocketbook.de/media/logo/stores/1/Logo_PocketBook_E-Books-u-E-Reader_green.png',
                'login' => [
                    'native' => [
                        'url' => 'https://pocketbook.de/de_de/pbcloud/api/partnerauthapi',
                    ],
                    'browser' => [
                        'url' => 'https://pocketbook.de/de_de/customer/account/login/',
                    ],
                ],
            ],
        ];

        return $dto;
    }

    public function login(string $dtoClass, array $attributes): AuthTokenDto
    {
        /** @var AuthTokenDto $dto */
        $dto = $this->dtoFactory->create($dtoClass, $attributes);

        $provider = $this->providerRepository->findOneByAlias($dto->providerAlias);
        if ($provider === null) {
            throw new ProviderNotFoundException(
                sprintf('Provider "%s" not found', $dto->providerAlias),
                ProviderNotFoundException::NOT_FOUND_CODE
            );
        }

        $user = $this->userRepository->findOneByProviderAndEmail($provider, $dto->username);

        $token = $this->tokenGenerator->generateUserToken($user);
        $dto->access_token = $this->tokenGenerator->getTokenString($token, $token->getAccessToken());
        $dto->refresh_token = $this->tokenGenerator->getTokenString($token, $token->getRefreshToken());
        $dto->expired = $token->getExpiredAt();

        return $dto;
    }
}