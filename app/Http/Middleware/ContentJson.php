<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ContentJson
{
    /**
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next): mixed
    {
        $response = $next($request);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }
}
