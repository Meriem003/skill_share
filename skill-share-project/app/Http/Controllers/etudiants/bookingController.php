<?php

namespace App\Http\Controllers\etudiants;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;    


class bookingController extends Controller
{
    public function index()
    {
        return view('student.booking');
    }
    public function create()
    {
        return view('student.booking');
    }
    public function store(Request $request)
    {
        // Logique pour enregistrer une réservation
        // ...
        return redirect()->route('etudiant.booking')->with('success', 'Réservation créée avec succès.');
    }
    public function show($id)
    {
        // Logique pour afficher une réservation spécifique
        // ...
        return view('student.booking.show', compact('reservation'));
    }
    public function edit($id)
    {
        // Logique pour afficher le formulaire d'édition d'une réservation
        // ...
        return view('student.booking.edit', compact('reservation'));
    }
    
}
