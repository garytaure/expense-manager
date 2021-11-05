<?php

namespace App\Http\Middleware;

use Closure;
use App\User;
use Illuminate\Support\Facades\Auth;

class APITokenAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $api_token = $request->header('X-API-TOKEN');
        $user = User::where('api_token', $api_token)->first();
        if ($user) {
            Auth::login($user);
        } else {
            if ($request->acceptsJson()) {
                return response()->json(null, 401);
            } else {
                return abort(403);
            }
        }
        return $next($request);
    }
}