<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;



class CheckRole
{
    public function handle(Request $request, Closure $next, $role)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();

        // Vérification des rôles
        if ($role === 'admin' ) {
            return redirect()->route('dashboard')->with('error', 'Accès refusé. Vous n\'avez pas les permissions nécessaires.');
        }

        if ($role === 'etudiant') {
            return redirect()->route('admin.dashboard')->with('error', 'Accès refusé. Cette page est réservée aux étudiants.');
        }

        return $next($request);
    }
}