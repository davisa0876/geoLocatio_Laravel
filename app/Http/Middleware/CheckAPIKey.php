<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\User;

class CheckAPIKey
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $apiKey = $request->header('api_token');

        if (!$apiKey) {
            return response()->json(['error' => 'API Key required'], 401);
        }
        $user = User::where('api_token', $apiKey)->first();
        if (!$user) {
            return response()->json(['error' => 'Invalid API Key'], 401);
        }
        return $next($request);
    }
}
