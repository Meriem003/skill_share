<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Etudiant;
use App\Models\Skill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        $skills = Skill::all();
        return view('auth.register', compact('skills'));
    }

    public function register(Request $request)
    {
        // Validation
        $request->validate([
            'fullname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'campus' => 'required|string|in:paris,lyon,marseille,bordeaux',
            'password' => 'required|string|min:8|confirmed',
            'teaching_skills' => 'required|array|min:1',
            'learning_skills' => 'required|array|min:1',
            'terms' => 'required|accepted',
        ]);

        // Création de l'utilisateur (notez que le champ est 'Fullname' avec un F majuscule selon votre modèle)
        $user = User::create([
            'Fullname' => $request->fullname,
            'email' => $request->email,
            'password' => $request->password, // Déjà hashé grâce à votre mutateur dans le modèle
            'campus' => $request->campus,
            'role' => 'etudiant',
        ]);

        // Création du profil étudiant
        $etudiant = Etudiant::create([
            'user_id' => $user->id,
            'rang' => 1 // Rang initial
        ]);

        // Enregistrement des compétences à enseigner
        if ($request->has('teaching_skills')) {
            foreach ($request->teaching_skills as $skill) {
                $etudiant->teachingSkills()->attach($skill);
            }
        }

        // Enregistrement des compétences à apprendre
        if ($request->has('learning_skills')) {
            foreach ($request->learning_skills as $skill) {
                $etudiant->learningSkills()->attach($skill);
            }
        }

        // Connexion automatique
        Auth::login($user);

        return redirect()->route('dashboard')->with('success', 'Inscription réussie! Bienvenue sur SkillShare.');
    }
}