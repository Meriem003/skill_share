<?php

namespace App\Http\Controllers\visiteure;

use App\Http\Controllers\Controller;
use App\Models\User;

class VisitprofileController extends Controller
{
    public function show($id)
    {
        // Récupérer l'utilisateur avec ses relations
        $user = User::with([
            'etudiant.teachingSkills', // Compétences à enseigner
            'etudiant.learningSkills', // Compétences à apprendre
            'etudiant.badges', // Badges
            'etudiant.evaluationsRecues.auteur.user', // Évaluations avec auteur
            'etudiant.courses', // Charger les cours créés par l'étudiant
        ])->findOrFail($id);
    
        // Vérifier si l'utilisateur est lié à un étudiant
        if (!$user->etudiant) {
            abort(404, 'Profil étudiant introuvable.');
        }
    
        // Retourner la vue avec les données de l'utilisateur
        return view('visiteure.profile', compact('user'));
    }
}