<?php

namespace App\Http\Middleware;

use Closure;

use Illuminate\Support\Facades\Auth;

class Master {

    public function handle($request, Closure $next)
    {

        if ( Auth::check() && Auth::user()->isAdmin() && Auth::user()->isMaster() )
        {
            return $next($request);
        }

        return redirect('/');

    }

}
