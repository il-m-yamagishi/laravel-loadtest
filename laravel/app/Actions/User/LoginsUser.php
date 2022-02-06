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
use Illuminate\Support\Facades\Log;

class LoginsUser
{
    /**
     * @param array{password:string, login_token:string} $input
     * @return User
     */
    public function __invoke(array $input): User
    {
        return DB::transaction(function () use ($input): User {
            $user = User::where('login_token', $input['login_token'])->first();

            if ($user === null) {
                throw new UserNotFoundException('User not found');
            }

            if (!Hash::check($input['password'], $user->password)) {
                throw new UserNotFoundException('Invalid password');
            }

            if (Hash::needsRehash($user->password)) {
                $user->password = Hash::make($input['password']);
                $user->save();
                Log::info('Rehashed', ['id' => $user->id]);
            }

            Log::info('User logged in', ['id' => $user->id]);

            return $user;
        });
    }
}
