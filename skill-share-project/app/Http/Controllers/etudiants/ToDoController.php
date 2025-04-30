<?php

namespace App\Http\Controllers\etudiants;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Tache;
use App\Models\TodoListe;

class ToDoController extends Controller
{
    public function index()
    {
        $etudiant = Auth::user()->etudiant;

        if (!$etudiant) {
            abort(404, "Profil étudiant introuvable.");
        }

        $taches = Tache::whereHas('todoListe', function ($query) use ($etudiant) {
            $query->where('etudiant_id', $etudiant->id);
        })->get();

        return view('student.todo', compact('taches'));
    }

    public function create()
    {
        // Afficher le formulaire d'ajout d'une tâche
        return view('student.create_todo');
    }

    public function store(Request $request)
    {
        $etudiant = Auth::user()->etudiant;

        if (!$etudiant) {
            abort(404, "Profil étudiant introuvable.");
        }

        // Validation des données du formulaire
        $validated = $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'nullable|string',
            'date_limite' => 'nullable|date',
            'statut' => 'nullable|string|in:en attente,en cours,terminée',
        ]);

        // Associer la tâche à une liste de tâches de l'étudiant
        $todoListe = $etudiant->todoListes()->first(); // On prend la première liste de tâches de l'étudiant
        
        // Si l'étudiant n'a pas encore de liste de tâches, on en crée une
        if (!$todoListe) {
            $todoListe = new TodoListe();
            $todoListe->etudiant_id = $etudiant->id;
            $todoListe->titre = "Liste de tâches principale";
            $todoListe->save();
        }

        // Créer une nouvelle tâche
        $todoListe->taches()->create($validated);

        // Rediriger vers la page des tâches avec un message de succès
        return redirect()->route('etudiant.todo')->with('success', 'Tâche ajoutée avec succès.');
    }
}