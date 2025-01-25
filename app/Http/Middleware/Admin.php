<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        /** @phpstan-ignore-next-line */
        if (Auth::user() && Auth::user()->is_admin === 1) {
            return $next($request);
        }

        return response([
            'message' => 'You are not authorized to perform this action.',
        ], 403);
    }
}
