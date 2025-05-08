<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return \Illuminate\Http\Response
     */
    public function handle(Request $request, Closure $next, $role)
    {
        if (Auth::check()) {
            $user = Auth::user();

            if ($role === 'admin' && $user->role !== 'admin') {
                abort(403, 'Accès interdit');
            }

            if ($role === 'etudiant' && $user->role !== 'etudiant') {
                abort(403, 'Accès interdit');
            }
        } else {
            return redirect()->route('login'); 
        }

        return $next($request);
    }
}
