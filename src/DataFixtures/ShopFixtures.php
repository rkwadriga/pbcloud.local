<?php

namespace App\DataFixtures;

use App\Entity\Enum\ProviderTypeEnum;
use App\Factory\ShopFactory;
use App\Repository\ProviderRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ShopFixtures extends Fixture implements DependentFixtureInterface
{
    public function __construct(
        private readonly ProviderRepository $providerRepository
    ) {}

    public function load(ObjectManager $manager): void
    {
        $providers = $this->providerRepository->findAll();
        foreach ($providers as $provider) {
            if ($provider->getType() === ProviderTypeEnum::PARTNER) {
                ShopFactory::createOne([
                    'provider' => $provider,
                ]);
            }
        }
    }

    public function getDependencies(): array
    {
        return [ProviderFixtures::class];
    }
}
