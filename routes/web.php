<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;

Route::get('/', fn (): array => ['Laravel' => app()->version()]);

require_once __DIR__.'/auth.php';
