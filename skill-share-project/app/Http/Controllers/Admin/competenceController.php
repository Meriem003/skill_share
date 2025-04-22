<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class competenceController extends Controller
{
    public function index()
    {
        return view('admin.compétences');
    }
}
