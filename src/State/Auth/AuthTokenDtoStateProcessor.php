<?php declare(strict_types=1);
/**
 * Created 2023-11-21 15:04:21
 * Author rkwadriga
 */

namespace App\State\Auth;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProcessorInterface;

class AuthTokenDtoStateProcessor implements ProcessorInterface
{
    public function process(mixed $data, Operation $operation, array $uriVariables = [], array $context = [])
    {
        return $data;
    }
}