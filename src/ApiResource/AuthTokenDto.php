<?php declare(strict_types=1);
/**
 * Created 2023-11-20 11:03:01
 * Author rkwadriga
 */

namespace App\ApiResource;

use ApiPlatform\Metadata;
use App\Dto\AbstractDto;
use App\State\Auth\AuthStateProvider;
use DateTime;
use Symfony\Component\Validator\Constraints as Assert;

#[Metadata\ApiResource(
    shortName: 'Auth',
    operations: [
        new Metadata\Post(
            uriTemplate: '/auth/login/{providerAlias}',
            inputFormats: ['form_urlencoded'],
            outputFormats: ['json'],
            uriVariables: [
                'providerAlias' => '',
            ],
            requirements: [
                'providerAlias' => '\w+',
            ],
            denormalizationContext: ['format' => 'json'],
            security: 'is_granted("PUBLIC_ACCESS")',
        )
    ],
    provider: AuthStateProvider::class
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

    public ?string $access_token = null;

    public ?string $refresh_token = null;

    public ?DateTime $expired = null;
}