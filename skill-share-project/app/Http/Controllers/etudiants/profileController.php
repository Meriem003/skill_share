<?php
namespace App\Http\Controllers\etudiants;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Skill;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        // Charger l'utilisateur connecté avec ses relations
        $user = User::with([
            'etudiant.teachingSkills',
            'etudiant.learningSkills',
            'etudiant.badges',
            'etudiant.evaluationsRecues.auteur',
        ])->find(Auth::id());

        // Vérifier si l'utilisateur est lié à un étudiant
        if (!$user->etudiant) {
            abort(404, 'Profil étudiant introuvable.');
        }

        // Retourner les données à la vue
        return view('student.profile', compact('user'));
    }

    public function edit()
    {
        // Récupérer l'utilisateur connecté avec ses relations
        $user = Auth::user();
        $skills = Skill::all(); // Récupérer toutes les compétences disponibles

        // Vérifier si l'utilisateur est lié à un étudiant
        if (!$user->etudiant) {
            abort(404, 'Profil étudiant introuvable.');
        }

        // Retourner les données à une vue de modification
        return view('student.edit-profile', compact('user', 'skills'));
    }

    public function update(Request $request)
    {
        // Récupérer l'utilisateur connecté
        $user = Auth::user();

        // Validation des données
        $validated = $request->validate([
            'fullname' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id, // Vérifie l'unicité de l'email
            'campus' => 'nullable|string|max:255',
            'teaching_skills' => 'array|nullable',
            'learning_skills' => 'array|nullable',
        ]);

        // Mise à jour des informations de l'utilisateur
        $user->update([
            'fullname' => $validated['fullname'],
            'email' => $validated['email'],
            'campus' => $validated['campus'],
        ]);

        // Mise à jour des compétences
        $user->etudiant->teachingSkills()->sync($validated['teaching_skills'] ?? []);
        $user->etudiant->learningSkills()->sync($validated['learning_skills'] ?? []);

        // Rediriger avec un message de succès
        return redirect()->route('etudiant.profile')->with('success', 'Votre profil a été mis à jour avec succès.');
    }
}