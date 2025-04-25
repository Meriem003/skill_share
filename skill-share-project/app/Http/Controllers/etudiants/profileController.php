<?php
namespace App\Http\Controllers\etudiants;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        // Charger l'utilisateur connecté avec ses relations
        $user = User::with([
            'etudiant.teachingSkills', // Compétences à enseigner
            'etudiant.learningSkills', // Compétences à apprendre
            'etudiant.badges', // Badges
            'etudiant.evaluationsRecues.auteur', // Évaluations avec auteur
        ])->find(Auth::id());

        // Vérifier si l'utilisateur est lié à un étudiant
        if (!$user->etudiant) {
            abort(404, 'Profil étudiant introuvable.');
        }

        // Retourner les données à la vue
        return view('student.profile', compact('user'));
    }
}