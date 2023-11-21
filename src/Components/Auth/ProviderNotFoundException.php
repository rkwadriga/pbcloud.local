<?php declare(strict_types=1);
/**
 * Created 2023-11-17 17:41:58
 * Author rkwadriga
 */

namespace App\Components\Auth;

class ProviderNotFoundException extends AuthException
{
    const NOT_FOUND_CODE = 65578223814;
}