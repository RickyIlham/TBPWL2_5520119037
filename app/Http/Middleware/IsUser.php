<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Illuminate\Http\Facades\Auth;
use Closure;

class IsUser
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
        if(auth()->user()->roles_id == 2){
            return $next($request);
        }
        
        return redirect()->route('home');
    }
}
