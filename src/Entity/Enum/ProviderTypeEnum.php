<?php declare(strict_types=1);
/**
 * Created 2023-11-16 09:16:00
 * Author rkwadriga
 */

namespace App\Entity\Enum;

enum ProviderTypeEnum: string
{
    case PARTNER = 'partner';
    case LOCAL = 'local';
}
