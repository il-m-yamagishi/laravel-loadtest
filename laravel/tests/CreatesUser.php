<?php

/**
 * @author    Masaru Yamagishi <yamagishi.iloop@gmail.com>
 * @copyright 2022 Masaru Yamagishi
 * @license   Apache License 2.0
 */

declare(strict_types=1);

namespace Tests;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

trait CreatesUser
{
    /**
     */
    public function createUser(): User
    {
        $login_token = Str::random(64);
        $password = Str::random(64);
        return User::factory()->create([
            'login_token' => $login_token,
            'password' => Hash::make($password),
        ]);
    }
}
