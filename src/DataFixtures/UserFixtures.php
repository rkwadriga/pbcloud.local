<?php

namespace App\DataFixtures;

use App\Constants\ProviderAliases;
use App\Constants\Roles;
use App\Entity\Enum\ProviderTypeEnum;
use App\Factory\UserFactory;
use App\Repository\ProviderRepository;
use App\Repository\ShopRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class UserFixtures extends Fixture implements DependentFixtureInterface
{
    public function __construct(
        private readonly ProviderRepository $providerRepository,
        private readonly ShopRepository $shopRepository
    ) {}

    public function load(ObjectManager $manager): void
    {
        $localProvider = $this->providerRepository->findOneByAlias(ProviderAliases::LOCAL);

        UserFactory::createOne([
            'provider' => $localProvider,
            'providerUserId' => null,
            'email' => 'admin@mail.com',
            'firstName' => 'Admin',
            'lastName' => 'Admin',
            'plainPassword' => '12345678',
            'roles' => [Roles::ADMIN],
        ]);

        $shops = $this->shopRepository->findAll();
        foreach ($shops as $shop) {
            $provider = $shop->getProvider();
            if ($provider->getType() === ProviderTypeEnum::PARTNER) {
                if ($provider->getAlias() === ProviderAliases::DEV24_POCKETBOOK_DE) {
                    UserFactory::createOne([
                        'provider' => $provider,
                        'shop' => $shop,
                        'email' => 'dmitry.kushneriov@obreey-products.com',
                        'firstName' => 'Dmitry',
                        'lastName' => 'Kushneriov',
                    ]);
                }
                UserFactory::createOne([
                    'provider' => $provider,
                    'shop' => $shop,
                ]);
            }
        }
    }

    public function getDependencies(): array
    {
        return [
            ProviderFixtures::class,
            ShopFixtures::class,
        ];
    }
}
