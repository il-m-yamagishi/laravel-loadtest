<?php

/**
 * @author    Masaru Yamagishi <yamagishi.iloop@gmail.com>
 * @copyright 2022 Masaru Yamagishi
 * @license   Apache License 2.0
 */

declare(strict_types=1);

use Illuminate\Support\Facades\Route;

Route::get ('/',         \App\Http\Controllers\IndexController::class);
Route::post('/register', \App\Http\Controllers\User\RegisterController::class);
Route::post('/login',    \App\Http\Controllers\User\LoginController::class)->name('login');

Route::group([
    'middleware' => 'auth',
], function () {
    Route::get('/user', \App\Http\Controllers\User\IndexController::class);
});
