<?php declare(strict_types=1);
/**
 * Created 2023-11-16 15:15:58
 * Author rkwadriga
 */

namespace App\Entity\Enum;

enum TokenTypeEnum: string
{
    case PROVIDER = 'provider';
    case USER = 'user';
}
