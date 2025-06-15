<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class ApiAuthenticate extends Middleware
{
    /**
     * Override redirectTo jika request bukan JSON.
     */
    protected function redirectTo(Request $request): ?string
    {
        // Untuk request API, jangan redirect ke login route
        if (! $request->expectsJson()) {
            return null; // Atau bisa return '/login' jika kamu punya UI login
        }

        return null;
    }
}
