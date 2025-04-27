<?php

namespace App\Http\Controllers\visiteure;
use App\Http\Controllers\Controller;
use App\Models\Skill;
use App\Models\User;

use Illuminate\Http\Request;

class CoursController extends Controller
{
    public function index()
    {
        // Logique pour afficher la liste des cours
        return view('visiteure.cours');
    }
}
