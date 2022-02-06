<?php

/**
 * @author    Masaru Yamagishi <yamagishi.iloop@gmail.com>
 * @copyright 2022 Masaru Yamagishi
 * @license   Apache License 2.0
 */

declare(strict_types=1);

namespace App\Http\Controllers\User;

use App\Http\Controllers\Request;

final class RegisterRequest extends Request
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email', 'min:5', 'max:255'],
            'password' => ['required', 'string', 'max:64'],
        ];
    }
}
