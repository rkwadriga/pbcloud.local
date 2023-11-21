<?php declare(strict_types=1);
/**
 * Created 2023-11-21 16:16:17
 * Author rkwadriga
 */

namespace App\Serializer;

use Symfony\Component\Serializer\Encoder\DecoderInterface;

class ContentFromDecoder implements DecoderInterface
{
    public function __construct(
        private readonly string $format
    ) {}

    public function decode(string $data, string $format, array $context = [])
    {
        if (!trim($data)) {
            return [];
        }

        parse_str(urldecode($data), $result);

        return $result;
    }

    public function supportsDecoding(string $format)
    {
        return $this->format === $format;
    }
}