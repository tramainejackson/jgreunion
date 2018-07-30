<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckAdmin
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
		$user = Auth::user();
		
		if(!$user->is_admin()) {
			return redirect()->action('FamilyMemberController@edit', ['member' => $user->member->id]);
		}
		
        return $next($request);
    }
}
