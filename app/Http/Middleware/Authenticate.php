<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    public function unauthenticated($request, AuthenticationException $exception) {
    return response()->json([
        'success' => false,
        'message' => 'Unauthenticated.',
    ], 401);
    }

}
