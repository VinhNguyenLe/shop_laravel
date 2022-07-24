<?php

namespace App\Http\Middleware;
use Closure;

use Auth;
use Illuminate\Support\Facades\Route;

class AccessPermission
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
        if(Auth::user()->hasAnyRoles(['admin', 'manager'])){
            return $next($request);
        }

        return redirect('/dashboard');
    }
}