<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Etudiant;
use App\Models\Skill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
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
        $user = User::create([
            'Fullname' => $request->fullname,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'campus' => $request->campus,
            'role' => 'etudiant',
        ]);

        $etudiant = Etudiant::create([
            'user_id' => $user->id,
            'rang' => 1
        ]);
        if ($request->has('teaching_skills')) {
            foreach ($request->teaching_skills as $skill) {
                $etudiant->teachingSkills()->attach($skill);
            }
        }
        if ($request->has('learning_skills')) {
            foreach ($request->learning_skills as $skill) {
                $etudiant->learningSkills()->attach($skill);
            }
        }
        Auth::login($user);
        return redirect()->route('etudiant.dashboard');            }
            public function showLogin()
            {
                return view('auth.login');
            }
            public function login(Request $request)
            {
                $credentials = $request->validate([
                    'email' => 'required|email',
                    'password' => 'required',
                ]);
            
                if (Auth::attempt($credentials)) {
                    $user = Auth::user();
                    if ($user->role === 'admin') {
                        return redirect()->route('admin.dashboard');
                    } elseif ($user->role === 'etudiant') {
                        return redirect()->route('etudiant.dashboard');
                    }
                    return redirect()->route('home');
                }
            
                return back()->withErrors([
                    'email' => 'Identifiants invalides',
                ]);
            }
            public function logout(Request $request)
            {
                Auth::logout();
                return redirect('/');
            }
}