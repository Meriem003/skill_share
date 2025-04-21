<?php

namespace App\Http\Controllers\etudiants;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;    


class profileController extends Controller
{
    public function index()
    {
        return view('student.profile');
    }
}
