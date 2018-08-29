<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use App\Models\User;
class CheckAuthD
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
        $userId = Auth::id();
        $user = User::find($userId);
         if($user->fk_idSecurity != 3){
           return redirect()->back();
    }
    return $next($request);
    }
}
