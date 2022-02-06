<?php

/**
 * @author    Masaru Yamagishi <yamagishi.iloop@gmail.com>
 * @copyright 2022 Masaru Yamagishi
 * @license   Apache License 2.0
 */

declare(strict_types=1);

namespace Tests\Feature\User;

use Tests\TestCase;

class IndexTest extends TestCase
{
    /**
     * @test
     */
    public function ログイン情報が表示されること()
    {
        $user = $this->createUser();

        $response = $this->actingAs($user)
            ->withHeader('Accept', 'application/json')
            ->getJson('/user');

        $response->assertOk();
        $this->assertSame($user->name, $response['name']);
    }
}
