<?php

namespace App\Http\Controllers\etudiants;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;    
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class profileController extends Controller
{
    public function index()
    {
        $user = Auth::user(); // Récupérer l'utilisateur connecté
        return view('student.profile', compact('user'));
    }

    // public function update(Request $request)
    // {
    //     $user = Auth::user(); // Récupérer l'utilisateur connecté

    //     // Valider les données du formulaire
    //     $request->validate([
    //         'name' => 'required|string|max:255',
    //         'campus' => 'nullable|string|max:255',
    //         'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    //     ]);

    //     // Mettre à jour les informations de l'utilisateur
    //     $user->name = $request->input('name');
    //     $user->campus = $request->input('campus');

    //     // Si un nouvel avatar est téléchargé
    //     if ($request->hasFile('avatar')) {
    //         $avatarPath = $request->file('avatar')->store('avatars', 'public');
    //         $user->avatar = $avatarPath;
    //     }

    //     $user->save();
    //     return redirect()->back()->with('success', 'Profil mis à jour avec succès.');
    // }
}