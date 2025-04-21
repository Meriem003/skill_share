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

            // Vérification directe du rôle dans la base de données
            if ($role === 'admin' && $user->role !== 'admin') {
                abort(403, 'Accès interdit');
            }

            if ($role === 'etudiant' && $user->role !== 'etudiant') {
                abort(403, 'Accès interdit');
            }
        } else {
            return redirect()->route('login'); // Redirige vers la page de connexion si l'utilisateur n'est pas authentifié
        }

        return $next($request);
    }
}
