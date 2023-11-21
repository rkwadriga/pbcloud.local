<?php declare(strict_types=1);
/**
 * Created 2023-11-17 17:03:45
 * Author rkwadriga
 */

namespace App\Dto;

abstract class AbstractDto
{
    public function __construct(
        private readonly array $params = []
    ) {
        $this->init();
    }

    protected function init(): void
    {
        foreach ($this->params as $name => $value)
        {
            $setter = 'set' . ucfirst($name);
            if (method_exists($this, $setter)) {
                $this->$setter($name);
            } elseif (property_exists($this, $name)) {
                $this->$name = $value;
            }
        }
    }
}