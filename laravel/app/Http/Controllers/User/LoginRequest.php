<?php

/**
 * @author    Masaru Yamagishi <yamagishi.iloop@gmail.com>
 * @copyright 2022 Masaru Yamagishi
 * @license   Apache License 2.0
 */

declare(strict_types=1);

namespace App\Http\Controllers\User;

use App\Http\Controllers\Request;

final class LoginRequest extends Request
{
    public function rules(): array
    {
        return [
            'password' => ['required', 'string', 'max:64'],
            'login_token' => ['required', 'string', 'max:64'],
        ];
    }
}
