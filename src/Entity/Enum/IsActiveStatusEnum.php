<?php declare(strict_types=1);
/**
 * Created 2023-11-16 09:14:37
 * Author rkwadriga
 */

namespace App\Entity\Enum;

enum IsActiveStatusEnum: string
{
    case ACTIVE = 'active';
    case NOT_ACTIVE = 'not_active';
}
