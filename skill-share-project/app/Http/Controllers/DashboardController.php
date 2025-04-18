<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $etudiant = $user->etudiant;
        $teachingSkills = $etudiant->teachingSkills;
        $learningSkills = $etudiant->learningSkills;
        
        return view('dashboard', compact('user', 'etudiant', 'teachingSkills', 'learningSkills'));
    }
}