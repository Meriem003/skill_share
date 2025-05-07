<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Session;
use App\Models\Evaluation;
use App\Models\Badge;
use App\Models\Skill;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    /**
     * Affiche le tableau de bord administrateur avec statistiques de base
     */
    public function index()
    {
        // Statistiques simples à afficher sur le tableau de bord
        $stats = [
            // Nombre total d'utilisateurs
            'users_count' => User::count(),
            
            // Nombre de sessions terminées
            'sessions_count' => Session::where('statut', 'terminé')->count(),
            
            // Note moyenne des évaluations (avec une valeur par défaut)
            'average_rating' => Evaluation::avg('note') ?? 0,
            
            // Nombre de badges attribués
            'badges_count' => DB::table('etudiant_badge')->count(),
            
            // 5 compétences les plus utilisées dans les sessions
            'popular_skills' => $this->getPopularSkills(),
        ];
        
        // Passer les statistiques à la vue
        return view('admin.dashboard', compact('stats'));
    }
    
    /**
     * Récupère les compétences les plus populaires
     */
    private function getPopularSkills()
    {
        // Récupérer les 5 compétences les plus utilisées dans les sessions
        $skills = Skill::select('skills.id', 'skills.nom', DB::raw('COUNT(sessions.id) as sessions_count'))
            ->leftJoin('sessions', 'skills.id', '=', 'sessions.skill_id')
            ->groupBy('skills.id', 'skills.nom')
            ->orderByDesc('sessions_count')
            ->limit(5)
            ->get();
            
        // Si aucune session n'existe encore, éviter la division par zéro
        $maxCount = $skills->max('sessions_count') ?: 1;
        
        // Calculer le pourcentage pour les barres de progression
        foreach ($skills as $skill) {
            $skill->percentage = ($skill->sessions_count / $maxCount) * 100;
        }
        
        return $skills;
    }
}