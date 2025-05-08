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
        return view('visiteure.cours');
    }
}
