<?php

/**
 * @author    Masaru Yamagishi <yamagishi.iloop@gmail.com>
 * @copyright 2022 Masaru Yamagishi
 * @license   Apache License 2.0
 */

declare(strict_types=1);

namespace App\Actions\User;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CreatesUser
{
    /**
     * @param array{name:string, email:string, password:string} $input
     * @return string login_token
     */
    public function __invoke(array $input): string
    {
        return DB::transaction(function () use ($input): string {
            $plain_login_token = Str::random(64);
            User::create([
                'name' => $input['name'],
                'email' => $input['email'],
                'password' => Hash::make($input['password']),
                'login_token' => $plain_login_token,
            ]);

            return $plain_login_token;
        });
    }
}
