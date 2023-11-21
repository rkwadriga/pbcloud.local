<?php declare(strict_types=1);
/**
 * Created 2023-11-20 11:03:01
 * Author rkwadriga
 */

namespace App\ApiResource;

use ApiPlatform\Metadata;
use App\Dto\AbstractDto;
use App\State\Auth\AuthTokenDtoStateProvider;
use DateTime;
use Symfony\Component\Validator\Constraints as Assert;

#[Metadata\ApiResource(
    shortName: 'Login',
    operations: [
        new Metadata\Post(
            uriTemplate: '/auth/login/{providerAlias}',
            uriVariables: [
                'providerAlias' => '',
            ],
            requirements: [
                'providerAlias' => '\w+',
            ],
            security: 'is_granted("PUBLIC_ACCESS")',
        )
    ],
    provider: AuthTokenDtoStateProvider::class,
    //processor: AuthTokenDtoStateProcessor::class,
)]
class AuthTokenDto extends AbstractDto
{
    #[Metadata\ApiProperty(readable: false)]
    #[Assert\NotBlank]
    public ?string $providerAlias = null;

    #[Metadata\ApiProperty(readable: false)]
    #[Assert\NotBlank]
    public ?string $username = null;

    #[Metadata\ApiProperty(readable: false)]
    #[Assert\NotBlank]
    public ?string $password = null;

    #[Metadata\ApiProperty(example: "dToyOjg3ZWFkNDU3ZDNhZjY5M2I2ZGQzMmQ0ODI2MTM3N2Nk")]
    public ?string $access_token = null;

    #[Metadata\ApiProperty(example: "dToyOjA1YmViNzU1NjgzOGVhYmFkODJhMWYxNjc3MTQ4NzBi")]
    public ?string $refresh_token = null;

    #[Metadata\ApiProperty(example: "2023-11-21T17:33:49+00:00")]
    public ?DateTime $expired = null;
}