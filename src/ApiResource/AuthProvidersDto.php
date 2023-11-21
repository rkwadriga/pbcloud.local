<?php declare(strict_types=1);
/**
 * Created 2023-11-16 16:56:03
 * Author rkwadriga
 */

namespace App\ApiResource;

use ApiPlatform\Metadata;
use App\Dto\AbstractDto;
use App\State\Auth\AuthStateProvider;
use Symfony\Component\Validator\Constraints as Assert;

#[Metadata\ApiResource(
    shortName: 'Auth',
    description: 'Retrieves the list of allowed for login providers',
    operations: [
        new Metadata\Get(
            uriTemplate: '/auth/login',
            openapiContext: [
                'parameters' => [
                    [
                        'name' => 'username',
                        'in' => 'query',
                        'type' => 'string',
                        'required' => true,
                    ]
                ]
            ],
            security: 'is_granted("PUBLIC_ACCESS")',
        )
    ],
    provider: AuthStateProvider::class,
)]
class AuthProvidersDto extends AbstractDto
{
    #[Metadata\ApiProperty(readable: false)]
    #[Assert\NotBlank]
    public ?string $username = null;

    #[Metadata\ApiProperty(example: [
        'dev24_pocketbook_de' => [
            'name' => 'pocketbook.de',
            'clientID' => 1,
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
        ]
    ])]
    public array $auth_providers = [];
}