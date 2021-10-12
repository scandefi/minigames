<?php

namespace App\Http\Middleware;

use Helpers;
use Closure;
use Illuminate\Http\Request;

class Bot
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
        if(Helpers::botDetected()) return response()->json(['success' => false, 'message' => 'Unauthorized']);
        return $next($request);
    }
}
