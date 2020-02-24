<?php

namespace App\Http\Middleware;

use Closure;

class VerifyCsrfTokenForApis
{

    public function handle($request, Closure $next)
    {
        if ($request->hasCookie('XSRF-TOKEN') && $header = $request->header('X-XSRF-TOKEN')) {
            $cookie = $request->cookie('XSRF-TOKEN');
            if ($this->tokensMatch($cookie, $header)) {
                return $next($request);
            } else {
                dd('Here CSRF validation failed');
            }
        } else {
            dd('CSRF validation failed');
        }
    }
    
    private function tokensMatch($cookie, $header)
    {
        return is_string($cookie) &&
               is_string($header) &&
               ($cookie === $header);
    }
}
