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

        $user = User::with([
            'etudiant.teachingSkills',
            'etudiant.learningSkills',
            'etudiant.badges',
            'etudiant.evaluationsRecues.auteur',
            'etudiant.courses', 
        ])->find(Auth::id());

        if (!$user->etudiant) {
            abort(404, 'Profil étudiant introuvable.');
        }

        return view('student.profile', compact('user'));
    }

    public function edit()
    {

        $user = Auth::user();
        $skills = Skill::all(); 

        if (!$user->etudiant) {
            abort(404, 'Profil étudiant introuvable.');
        }

        return view('student.edit-profile', compact('user', 'skills'));
    }

    public function update(Request $request)
{
    $user = Auth::user();

    $validated = $request->validate([
        'fullname' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $user->id,
        'campus' => 'nullable|string|max:255',
        'teaching_skills' => 'array|nullable',
        'learning_skills' => 'array|nullable',
    ]);

    $user->fullname = $validated['fullname'];
    $user->email = $validated['email'];
    $user->campus = $validated['campus'];
    $user->save();

    $user->etudiant->teachingSkills()->sync($validated['teaching_skills'] ?? []);
    $user->etudiant->learningSkills()->sync($validated['learning_skills'] ?? []);

    return redirect()->route('etudiant.profile')->with('success', 'Votre profil a été mis à jour avec succès.');
}
}