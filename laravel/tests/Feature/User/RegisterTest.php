<?php

/**
 * @author    Masaru Yamagishi <yamagishi.iloop@gmail.com>
 * @copyright 2022 Masaru Yamagishi
 * @license   Apache License 2.0
 */

declare(strict_types=1);

namespace Tests\Feature\User;

use Illuminate\Support\Str;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    /**
     * @test
     */
    public function 新規登録が出来ること()
    {
        $uuid = Str::uuid()->toString();
        $response = $this->postJson('/register', [
            'name' => 'TEST_USER_' . $uuid,
            'email' => $uuid . '@laravel-load.test',
            'password' => 'secretsecret',
        ], [
            'Accept' => 'application/json',
        ]);

        $response->assertOk();
        $this->assertIsString($response['login_token']);
        $this->assertDatabaseHas('users', [
            'name' => 'TEST_USER_' . $uuid,
            'email' => $uuid . '@laravel-load.test',
        ]);
        $this->assertDatabaseMissing('users', [
            // パスワードがハッシュ化されていること
            'password' => 'secretsecret',
        ]);
    }
}
