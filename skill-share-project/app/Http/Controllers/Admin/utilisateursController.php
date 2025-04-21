<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class utilisateursController extends Controller
{
    public function index()
    {
        // Vue du dashboard pour les utilisateurs
        return view('admin.utilisateurs');
    }
    
}
