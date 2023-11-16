<?php

namespace App\DataFixtures;

use App\Constants\ProviderAliases;
use App\Entity\Enum\IsActiveStatusEnum;
use App\Entity\Enum\ProviderTypeEnum;
use App\Factory\ProviderFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ProviderFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        ProviderFactory::createOne([
            'name' => 'Local',
            'alias' => ProviderAliases::LOCAL,
            'api_key' => 'local',
            'type' => ProviderTypeEnum::LOCAL,
            'status' => IsActiveStatusEnum::ACTIVE,
        ]);

        ProviderFactory::createOne([
            'name' => 'dev24.pocketbook.de',
            'alias' => ProviderAliases::DEV24_POCKETBOOK_DE,
            'api_key' => 'evGEiQi1',
            'api_secret' => '6UAzm7fVbRpObjOpNbumuVEUF7E0yZL3OYJArD1',
            'type' => ProviderTypeEnum::PARTNER,
            'status' => IsActiveStatusEnum::ACTIVE,
            'extra' => [
                'getAuthOptionsUrl' => 'https://dev24.pocketbook.de/rest/V1/pbcloud/getauthoptions',
                'graphQlUrl' => 'https://dev24.pocketbook.de/graphql/',
                'secretKey' => 'kNVmhmbc9PvM1f0GdzEVSXKHsDCFhwofKIMxSNwI',
                'storeKey' => 'de_de',
                'storeLanguage' => 'de_DE',
                'widgetLifeTime' => 3600,
                'hashAlgo' => 'SHA256',
            ],
        ]);

        ProviderFactory::createOne([
            'name' => 'dev24.pocketbook.ua',
            'alias' => ProviderAliases::DEV24_POCKETBOOK_UA,
            'api_key' => '1JlAo3V',
            'api_secret' => 'EM5cIYD07Wxgk-V4tsguv8u_R-Br3dxiIM99dF',
            'type' => ProviderTypeEnum::PARTNER,
            'status' => IsActiveStatusEnum::ACTIVE,
            'extra' => [
                'getAuthOptionsUrl' => 'https://dev24.pocketbook.ua/rest/V1/pbcloud/getauthoptions',
                'graphQlUrl' => 'https://dev24.pocketbook.ua/graphql/',
                'secretKey' => 'kNVmhmbc9PvM1f0GdzEVSXKHsDCFhwofKIMxSNwI',
                'storeKey' => 'ua_ua',
                'storeLanguage' => 'ua_UA',
                'widgetLifeTime' => 3600,
                'hashAlgo' => 'SHA256',
            ],
        ]);

        ProviderFactory::createOne([
            'name' => 'dev24.pocketbook.es',
            'alias' => ProviderAliases::DEV24_POCKETBOOK_ES,
            'api_key' => 'SgeJ25Oa',
            'api_secret' => '_13E4Wj3huMRgI1LQCvVO6U2A7pH_gM93hbB',
            'type' => ProviderTypeEnum::PARTNER,
            'status' => IsActiveStatusEnum::ACTIVE,
            'extra' => [
                'getAuthOptionsUrl' => 'https://dev24.pocketbook.es/rest/V1/pbcloud/getauthoptions',
                'graphQlUrl' => 'https://dev24.pocketbook.es/graphql/',
                'secretKey' => 'kNVmhmbc9PvM1f0GdzEVSXKHsDCFhwofKIMxSNwI',
                'storeKey' => 'es_es',
                'storeLanguage' => 'es_ES',
                'widgetLifeTime' => 3600,
                'hashAlgo' => 'SHA256',
            ],
        ]);
    }
}
