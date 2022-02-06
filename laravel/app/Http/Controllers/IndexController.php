<?php

/**
 * @author    Masaru Yamagishi <yamagishi.iloop@gmail.com>
 * @copyright 2022 Masaru Yamagishi
 * @license   Apache License 2.0
 */

declare(strict_types=1);

namespace App\Http\Controllers;

final class IndexController extends Controller
{
    public function __invoke()
    {
        return [
            'ok' => true,
        ];
    }
}
