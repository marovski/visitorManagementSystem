<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Session;

class EnsureOrgAdmin
{
    public function handle($request, Closure $next)
    {
        if (!Auth::check() || !Auth::user()->isOrgAdmin()) {
            Session::flash('danger', 'You do not have permission to access this area.');
            return redirect()->route('dashboard');
        }

        return $next($request);
    }
}
