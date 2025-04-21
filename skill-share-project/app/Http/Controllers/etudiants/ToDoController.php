<?php

namespace App\Http\Controllers\etudiants;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;    


class ToDoController extends Controller
{
    public function index()
    {
        return view('student.todo');
    }
}
