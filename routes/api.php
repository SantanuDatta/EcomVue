<?php

declare(strict_types=1);

use App\Http\Controllers\Api\V1\CartItemController;
use App\Http\Controllers\Api\V1\ProductController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/user', [AuthenticatedSessionController::class, 'index']);

    Route::apiResource('/products', ProductController::class);

    Route::apiResource('/cart-items', CartItemController::class);

    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');
});
