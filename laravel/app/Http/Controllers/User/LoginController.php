<?php

/**
 * @author    Masaru Yamagishi <yamagishi.iloop@gmail.com>
 * @copyright 2022 Masaru Yamagishi
 * @license   Apache License 2.0
 */

declare(strict_types=1);

namespace App\Http\Controllers\User;

use App\Actions\User\LoginsUser;
use App\Http\Controllers\Controller;

final class LoginController extends Controller
{
    public function __invoke(LoginRequest $request, LoginsUser $action): LoginResponse
    {
        return new LoginResponse($action($request->validated()));
    }
}
