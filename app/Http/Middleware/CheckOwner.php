<?php

namespace App\Http\Middleware;

use App\Announcement;
use Closure;
use Auth;

class CheckOwner
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
        $annoucement=Announcement::findOrFail($request->id);
        if($annoucement->user_id != Auth::user()->id){
            return 'This is not your article!';
        }
        return $next($request);
    }
}
