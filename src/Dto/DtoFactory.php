<?php declare(strict_types=1);
/**
 * Created 2023-11-17 17:02:20
 * Author rkwadriga
 */

namespace App\Dto;

class DtoFactory
{
    /**
     * @param string $class
     * @param array<string, mixed> $params
     * @return AbstractDto
     * @throws DtoFactoryException
     */
    public function create(string $class, array $params = []): AbstractDto
    {
        if (!is_a($class, AbstractDto::class, true)) {
            throw new DtoFactoryException(
                sprintf('Invalid DTO-class %s. Every DTO-class must instance of %s', $class, AbstractDto::class),
                DtoFactoryException::INVALID_DTO_CLASS
            );
        }

        return new $class($params);
    }
}