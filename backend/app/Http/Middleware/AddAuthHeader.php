<?php

namespace App\Http\Middleware;

use Closure;

class AddAuthHeader
{

    public function handle($request, Closure $next)
    {
        if ($request->hasCookie('access_token')) {
            $token = $request->cookie('access_token');
            $request->headers->add(['Authorization' => 'Bearer ' . $token]);
        }

        return $next($request);
    }
}
