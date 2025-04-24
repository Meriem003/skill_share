<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class utilisateursController extends Controller
{
    //crud utulisateur
    // Afficher la liste des utilisateurs
    public function index()
    {
        // Récupérer les utilisateurs ayant le rôle "étudiant" avec pagination (10 par page)
        $etudiants = User::where('role', 'etudiant')->paginate(6);

        // Passer les données à la vue
        return view('admin.utilisateurs', compact('etudiants'));
    }
    // suprimer un utilisateur
    public function destroy($id)
    {
        // Trouver l'utilisateur par son ID
        $etudiant = User::findOrFail($id);

        // Supprimer l'utilisateur
        $etudiant->delete();

        // Rediriger vers la liste des utilisateurs avec un message de succès
        return redirect()->route('admin.utilisateurs')->with('success', 'Utilisateur supprimé avec succès.');
    }
    




    
}
