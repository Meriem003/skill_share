<?php

namespace App\Http\Controllers\etudiants;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;    


class searchController extends Controller
{
    public function index()
    {
        return view('student.search');
    }
    

}
