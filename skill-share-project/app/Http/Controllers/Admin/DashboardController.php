<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Etudiant;
use App\Models\Skill;

class DashboardController extends Controller
{
    public function index()
    {
        $totalUsers = User::count();
        $totalEtudiants = Etudiant::count();
        $totalSkills = Skill::count();
        
        return view('admin.dashboard', compact('totalUsers', 'totalEtudiants', 'totalSkills'));
    }
}