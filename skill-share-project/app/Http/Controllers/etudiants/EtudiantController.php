<?php

namespace App\Http\Controllers\etudiants;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Tache;
use App\Models\Session;
use App\Models\Evaluation;

class EtudiantController extends Controller
{
    public function index()
    {
        $etudiant = Auth::user()->etudiant;
    
        // Récupération des tâches
        $taches = Tache::whereHas('todoListe', function ($query) use ($etudiant) {
            $query->where('etudiant_id', $etudiant->id);
        })->get();
    
        // Récupération des sessions à venir
        $sessions = Session::where(function ($query) use ($etudiant) {
            $query->where('student_id', $etudiant->id)
                  ->orWhere('teacher_id', $etudiant->id);
        })
        ->where('statut', '!=', 'terminee')
        ->orderBy('date_session', 'asc')
        ->take(3)
        ->get();
        
        // Statistiques pour le dashboard-overview
        $stats = [
            'sessions_enseignees' => Session::where('teacher_id', $etudiant->id)
                                    ->where('statut', 'terminee')
                                    ->count(),
                                    
            'sessions_apprises' => Session::where('student_id', $etudiant->id)
                                    ->where('statut', 'terminee')
                                    ->count(),
                                    
            'evaluations_pendantes' => Session::where(function ($query) use ($etudiant) {
                                        $query->where('student_id', $etudiant->id)
                                            ->orWhere('teacher_id', $etudiant->id);
                                    })
                                    ->where('statut', 'terminee')
                                    ->whereDoesntHave('evaluations', function ($query) use ($etudiant) {
                                        $query->where('auteur_id', $etudiant->id);
                                    })
                                    ->count()
        ];
    
        return view('student.dashboard', compact('taches', 'sessions', 'stats'));
    }
}