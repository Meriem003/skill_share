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
            'categorie' => 'nullable|string|in:Haute,Moyenne,Basse',
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
    
    /**
     * Afficher le formulaire de modification d'une tâche
     */
    public function edit($id)
    {
        $etudiant = Auth::user()->etudiant;
        
        // Récupérer la tâche en s'assurant qu'elle appartient à l'étudiant connecté
        $tache = Tache::whereHas('todoListe', function ($query) use ($etudiant) {
            $query->where('etudiant_id', $etudiant->id);
        })->findOrFail($id);
        
        return view('student.edit_todo', compact('tache'));
    }
    
    /**
     * Mettre à jour une tâche existante
     */
    public function update(Request $request, $id)
    {
        $etudiant = Auth::user()->etudiant;
        
        // Récupérer la tâche en s'assurant qu'elle appartient à l'étudiant connecté
        $tache = Tache::whereHas('todoListe', function ($query) use ($etudiant) {
            $query->where('etudiant_id', $etudiant->id);
        })->findOrFail($id);
        
        // Validation des données du formulaire
        $validated = $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'nullable|string',
            'date_limite' => 'nullable|date',
            'statut' => 'nullable|string|in:en attente,en cours,terminée',
            'categorie' => 'nullable|string|in:Haute,Moyenne,Basse',
        ]);
        
        // Mettre à jour la tâche
        $tache->update($validated);
        
        return redirect()->route('etudiant.todo')->with('success', 'Tâche modifiée avec succès.');
    }
    
    /**
     * Supprimer une tâche
     */
    public function destroy($id)
    {
        $etudiant = Auth::user()->etudiant;
        
        // Récupérer la tâche en s'assurant qu'elle appartient à l'étudiant connecté
        $tache = Tache::whereHas('todoListe', function ($query) use ($etudiant) {
            $query->where('etudiant_id', $etudiant->id);
        })->findOrFail($id);
        
        // Supprimer la tâche
        $tache->delete();
        
        return redirect()->route('etudiant.todo')->with('success', 'Tâche supprimée avec succès.');
    }
    
    public function updateStatus(Request $request, $id)
    {
        $etudiant = Auth::user()->etudiant;
        
        // Récupérer la tâche en s'assurant qu'elle appartient à l'étudiant connecté
        $tache = Tache::whereHas('todoListe', function ($query) use ($etudiant) {
            $query->where('etudiant_id', $etudiant->id);
        })->findOrFail($id);
        
        // Validation
        $request->validate([
            'statut' => 'required|string|in:en attente,en cours,terminée',
        ]);
        
        // Mettre à jour le statut
        $tache->statut = $request->statut;
        $tache->save();
        
        // Si la requête est AJAX, retourner une réponse JSON
        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Statut mis à jour avec succès',
                'statut' => $tache->statut
            ]);
        }
        
        // Sinon, rediriger avec un message flash
        return redirect()->route('etudiant.todo')->with('success', 'Statut mis à jour avec succès.');
    }
    
    /**
     * Mettre à jour la catégorie d'une tâche
     */
    public function updateCategorie(Request $request, $id)
    {
        $etudiant = Auth::user()->etudiant;
        
        // Récupérer la tâche en s'assurant qu'elle appartient à l'étudiant connecté
        $tache = Tache::whereHas('todoListe', function ($query) use ($etudiant) {
            $query->where('etudiant_id', $etudiant->id);
        })->findOrFail($id);
        
        // Validation
        $request->validate([
            'categorie' => 'required|string|in:Haute,Moyenne,Basse',
        ]);
        
        // Mettre à jour la catégorie
        $tache->categorie = $request->categorie;
        $tache->save();
        
        // Si la requête est AJAX, retourner une réponse JSON
        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Catégorie mise à jour avec succès',
                'categorie' => $tache->categorie
            ]);
        }
        
        // Sinon, rediriger avec un message flash
        return redirect()->route('etudiant.todo')->with('success', 'Catégorie mise à jour avec succès.');
    }
}