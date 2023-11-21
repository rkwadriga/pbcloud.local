<?php declare(strict_types=1);
/**
 * Created 2023-11-21 07:43:31
 * Author rkwadriga
 */

namespace App\Constants;

class Routes
{
    public const AUTH_GET_PROVIDERS = '_api_/auth/login_get';
    public const AUTH_LOGIN = '_api_/auth/login/{provider_alias}_post';
}