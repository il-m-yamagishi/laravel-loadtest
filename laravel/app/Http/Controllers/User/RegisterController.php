<?php

/**
 * @author    Masaru Yamagishi <yamagishi.iloop@gmail.com>
 * @copyright 2022 Masaru Yamagishi
 * @license   Apache License 2.0
 */

declare(strict_types=1);

namespace App\Http\Controllers\User;

use App\Actions\User\CreatesUser;
use App\Http\Controllers\Controller;

final class RegisterController extends Controller
{
    public function __invoke(RegisterRequest $request, CreatesUser $action): RegisterResponse
    {
        return new RegisterResponse($action($request->validated()));
    }
}
