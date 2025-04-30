<?php

namespace App\Http\Controllers\etudiants;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Tache;

class EtudiantController extends Controller
{
    public function index()
    {
        // Récupérer l'étudiant connecté via l'utilisateur authentifié
        $etudiant = Auth::user()->etudiant;

        // Vérifier si l'étudiant existe
        if (!$etudiant) {
            abort(404, "Profil étudiant introuvable.");
        }

        // Récupérer les tâches associées aux listes de tâches de cet étudiant
        $taches = Tache::whereHas('todoListe', function ($query) use ($etudiant) {
            $query->where('etudiant_id', $etudiant->id);
        })->get();

        // Calculer le nombre de tâches terminées et le total
        $completedTasks = $taches->where('statut', 'completed')->count();
        $totalTasks = $taches->count();

        // Transmettre les données à la vue
        return view('student.dashboard', compact('taches', 'completedTasks', 'totalTasks'));
    }
}