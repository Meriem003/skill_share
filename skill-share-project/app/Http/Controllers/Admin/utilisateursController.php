<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class utilisateursController extends Controller
{
    // Afficher la liste des utilisateurs
    public function index(Request $request)
    {
        // Récupérer le paramètre de recherche
        $query = $request->input('q');

        // Récupérer les utilisateurs avec la pagination et la recherche
        $etudiants = User::where('role', 'etudiant')
            ->when($query, function ($queryBuilder, $searchTerm) {
                $queryBuilder->where('email', 'LIKE', '%' . $searchTerm . '%')
                             ->orWhere('fullname', 'LIKE', '%' . $searchTerm . '%')
                             ->orWhere('campus', 'LIKE', '%' . $searchTerm . '%');
            })
            ->paginate(6); // Pagination avec 6 résultats par page

        // Retourner la vue avec les données
        return view('admin.utilisateurs', compact('etudiants'));
    }

    public function suspendre($id)
    {
        $user = User::findOrFail($id);
    
        if ($user->status === 'actif') {
            $user->status = 'suspendu';
            $user->save();
    
            return redirect()->route('admin.utilisateurs')->with('success', 'Utilisateur suspendu avec succès.');
        }
    
        return redirect()->route('admin.utilisateurs')->with('error', 'L\'utilisateur n\'est pas actif.');
    }
    
    public function reactiver($id)
    {
        $user = User::findOrFail($id);
    
        if ($user->status === 'suspendu') {
            $user->status = 'actif';
            $user->save();
    
            return redirect()->route('admin.utilisateurs')->with('success', 'Utilisateur réactivé avec succès.');
        }
    
        return redirect()->route('admin.utilisateurs')->with('error', 'L\'utilisateur n\'est pas suspendu.');
    }
    
    public function supprimer($id)
    {
        $user = User::findOrFail($id);
    
        if ($user->delete()) {
            return redirect()->route('admin.utilisateurs')->with('success', 'Utilisateur supprimé avec succès.');
        }
    
        return redirect()->route('admin.utilisateurs')->with('error', 'Erreur lors de la suppression de l\'utilisateur.');
    }
}
