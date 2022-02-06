<?php

/**
 * @author    Masaru Yamagishi <yamagishi.iloop@gmail.com>
 * @copyright 2022 Masaru Yamagishi
 * @license   Apache License 2.0
 */

declare(strict_types=1);

namespace App\Http\Controllers\User;

use App\Http\Controllers\Response;

final class RegisterResponse extends Response
{
    public function __construct(private string $login_token)
    {

    }

    public function jsonSerialize(): array
    {
        return [
            'login_token' => $this->login_token,
        ];
    }
}
