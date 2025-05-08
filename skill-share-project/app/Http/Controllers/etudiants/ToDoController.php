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
        return view('student.create_todo');
    }

    public function store(Request $request)
    {
        $etudiant = Auth::user()->etudiant;

        if (!$etudiant) {
            abort(404, "Profil étudiant introuvable.");
        }

        $validated = $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'nullable|string',
            'date_limite' => 'nullable|date',
            'statut' => 'nullable|string|in:en attente,en cours,terminée',
            'categorie' => 'nullable|string|in:Haute,Moyenne,Basse',
        ]);


        $todoListe = $etudiant->todoListes()->first(); 
        
        if (!$todoListe) {
            $todoListe = new TodoListe();
            $todoListe->etudiant_id = $etudiant->id;
            $todoListe->titre = "Liste de tâches principale";
            $todoListe->save();
        }

        $todoListe->taches()->create($validated);

        return redirect()->route('etudiant.todo')->with('success', 'Tâche ajoutée avec succès.');
    }

    public function edit($id)
    {
        $etudiant = Auth::user()->etudiant;
        
        $tache = Tache::whereHas('todoListe', function ($query) use ($etudiant) {
            $query->where('etudiant_id', $etudiant->id);
        })->findOrFail($id);
        
        return view('student.edit_todo', compact('tache'));
    }

    public function update(Request $request, $id)
    {
        $etudiant = Auth::user()->etudiant;
        
        $tache = Tache::whereHas('todoListe', function ($query) use ($etudiant) {
            $query->where('etudiant_id', $etudiant->id);
        })->findOrFail($id);
        
        $validated = $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'nullable|string',
            'date_limite' => 'nullable|date',
            'statut' => 'nullable|string|in:en attente,en cours,terminée',
            'categorie' => 'nullable|string|in:Haute,Moyenne,Basse',
        ]);
        
        $tache->update($validated);
        
        return redirect()->route('etudiant.todo')->with('success', 'Tâche modifiée avec succès.');
    }

    public function destroy($id)
    {
        $etudiant = Auth::user()->etudiant;
        
        $tache = Tache::whereHas('todoListe', function ($query) use ($etudiant) {
            $query->where('etudiant_id', $etudiant->id);
        })->findOrFail($id);

        $tache->delete();
        
        return redirect()->route('etudiant.todo')->with('success', 'Tâche supprimée avec succès.');
    }
    
    public function updateStatus(Request $request, $id)
    {
        $etudiant = Auth::user()->etudiant;
        
        $tache = Tache::whereHas('todoListe', function ($query) use ($etudiant) {
            $query->where('etudiant_id', $etudiant->id);
        })->findOrFail($id);
        
        $request->validate([
            'statut' => 'required|string|in:en attente,en cours,terminée',
        ]);
        
        
        $tache->statut = $request->statut;
        $tache->save();
        
        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Statut mis à jour avec succès',
                'statut' => $tache->statut
            ]);
        }
        
        return redirect()->route('etudiant.todo')->with('success', 'Statut mis à jour avec succès.');
    }

    public function updateCategorie(Request $request, $id)
    {
        $etudiant = Auth::user()->etudiant;
        $tache = Tache::whereHas('todoListe', function ($query) use ($etudiant) {
            $query->where('etudiant_id', $etudiant->id);
        })->findOrFail($id);
        
        $request->validate([
            'categorie' => 'required|string|in:Haute,Moyenne,Basse',
        ]);

        $tache->categorie = $request->categorie;
        $tache->save();

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Catégorie mise à jour avec succès',
                'categorie' => $tache->categorie
            ]);
        }

        return redirect()->route('etudiant.todo')->with('success', 'Catégorie mise à jour avec succès.');
    }
}