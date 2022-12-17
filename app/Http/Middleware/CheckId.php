<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckId
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $id = $request->id;
        if (!is_numeric($id) || $id < 0 || is_float($id) ) {
            return response('ID error', 442);
        }
        return $next($request);
    }
}