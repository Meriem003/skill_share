<?php

namespace App\Http\Controllers\etudiants;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;    


class searchController extends Controller
{
    public function index()
    {
        return view('student.search');
    }
}
