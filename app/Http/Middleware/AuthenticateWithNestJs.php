<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Http;
class AuthenticateWithNestJs
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->bearerToken();
        
        if (!$token) {
            return response()->json(['message' => 'Unauthenticated'], 401);
        }

        $response = Http::withToken($token)->get('http://localhost:3000/nest/auth');

        if ($response->failed()) {
            return response()->json(['message' => 'Unauthenticated'], 401);
        }

        $user = $response->json('user');
        $request->merge(['user' => $user]);

        return $next($request);
    }
    
}
