<?php

namespace App\Http\Controllers\visiteure;

use App\Http\Controllers\Controller;
use App\Models\User;

class VisitprofileController extends Controller
{
    public function show($id)
    {
        $user = User::with([
            'etudiant.teachingSkills', 
            'etudiant.learningSkills', 
            'etudiant.badges', 
            'etudiant.evaluationsRecues.auteur.user', 
            'etudiant.courses',
        ])->findOrFail($id);
    
        if (!$user->etudiant) {
            abort(404, 'Profil étudiant introuvable.');
        }
    
        return view('visiteure.profile', compact('user'));
    }
}