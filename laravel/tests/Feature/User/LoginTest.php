<?php

/**
 * @author    Masaru Yamagishi <yamagishi.iloop@gmail.com>
 * @copyright 2022 Masaru Yamagishi
 * @license   Apache License 2.0
 */

declare(strict_types=1);

namespace Tests\Feature\User;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Tests\TestCase;

class LoginTest extends TestCase
{
    /**
     * @test
     */
    public function ログインが出来ること()
    {
        $login_token = Str::random(64);
        $password = Str::random(64);
        $user = User::factory()->create([
            'login_token' => $login_token,
            'password' => Hash::make($password),
        ]);

        $response = $this->withHeader('Accept', 'application/json')
            ->postJson('/login', compact('login_token', 'password'));

        $response->assertOk();
        $this->assertSame($user->name, $response['name']);
        $this->assertIsString($response['login_token']);
    }
}
