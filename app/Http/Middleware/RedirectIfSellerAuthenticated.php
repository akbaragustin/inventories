<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class RedirectIfSellerAuthenticated
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
        $data = \Session::get('auth');
         if (empty($data)) {
           return redirect('/login');
        }
        return $next($request);
    }
}
