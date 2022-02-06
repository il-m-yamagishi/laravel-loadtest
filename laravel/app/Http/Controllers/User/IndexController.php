<?php

/**
 * @author    Masaru Yamagishi <yamagishi.iloop@gmail.com>
 * @copyright 2022 Masaru Yamagishi
 * @license   Apache License 2.0
 */

declare(strict_types=1);

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Request;

final class IndexController extends Controller
{
    public function __invoke(Request $request): IndexResponse
    {
        return new IndexResponse($request->user());
    }
}
