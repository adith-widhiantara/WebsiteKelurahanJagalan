<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AduanIsValid
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
        $route = $request->route('aduan');

        if ($route->nonValid) {
            return back();
        }

        return $next($request);
    }
}
