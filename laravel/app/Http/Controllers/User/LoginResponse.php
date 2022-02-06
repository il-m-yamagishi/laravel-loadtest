<?php

/**
 * @author    Masaru Yamagishi <yamagishi.iloop@gmail.com>
 * @copyright 2022 Masaru Yamagishi
 * @license   Apache License 2.0
 */

declare(strict_types=1);

namespace App\Http\Controllers\User;

use App\Http\Controllers\Response;
use App\Models\User;

final class LoginResponse extends Response
{
    public function __construct(private User $user)
    {

    }

    public function jsonSerialize(): array
    {
        return [
            'name' => $this->user->name,
            'login_token' => $this->user->login_token,
        ];
    }
}
