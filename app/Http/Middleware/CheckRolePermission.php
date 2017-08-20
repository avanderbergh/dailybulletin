<?php

namespace App\Http\Middleware;

use Closure;

class CheckRolePermission
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
        if(!\Helper::canPost()){
            return response('User not authorized to create announcements', 401);
        };

        return $next($request);
    }
}