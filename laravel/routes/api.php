<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => ['ok' => true]);

Route::middleware('auth')->get('/user', function (Request $request) {
    return $request->user();
});
