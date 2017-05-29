<?php

namespace App\Http\Middleware;

use Auth;
use Closure;

class Permission
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
        $routeName = $request->route()->getName();
        if (Auth::check()) {
            if (Auth::user()->can($routeName)) {
                return $next($request);
            }
            return abort(403);
        }
        return toastr(['message' => '请登录','type' => 'error','path' => '/admin']);
    }
}
