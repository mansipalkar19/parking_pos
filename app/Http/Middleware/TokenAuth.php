<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;

class TokenAuth
{
    public function handle($request, Closure $next)
    {
        $token = $request->header('Authorization');

        if (!$token) {
            return response()->json(['error' => 'Token missing'], 401);
        }

        // Remove "Bearer "
        $token = str_replace('Bearer ', '', $token);

        $user = User::where('token', $token)->first();

        if (!$user) {
            return response()->json(['error' => 'Invalid Token'], 401);
        }

        // Attach logged-in user to request
        $request->user = $user;

        return $next($request);
    }
}
