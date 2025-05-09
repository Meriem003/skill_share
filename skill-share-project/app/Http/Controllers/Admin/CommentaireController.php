<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Evaluation;
use Illuminate\Http\Request;

class CommentaireController extends Controller
{
    public function index()
    {
        $evaluations = Evaluation::with(['session', 'auteur.user', 'evalue.user'])
            ->orderBy('created_at', 'desc')
            ->paginate(12);

        return view('admin.evaluation', compact('evaluations'));
    }
    public function search(Request $request)
    {
        $query = Evaluation::with(['session', 'auteur.user', 'evalue.user']);
        if ($request->filled('note')) {
            $query->where('note', $request->note);
        }
        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where('commentaire', 'LIKE', "%{$searchTerm}%")
                ->orWhereHas('session', function($q) use ($searchTerm) {
                    $q->where('titre', 'LIKE', "%{$searchTerm}%");
                })
                ->orWhereHas('auteur.user', function($q) use ($searchTerm) {
                    $q->where('Fullname', 'LIKE', "%{$searchTerm}%");
                })
                ->orWhereHas('evalue.user', function($q) use ($searchTerm) {
                    $q->where('Fullname', 'LIKE', "%{$searchTerm}%");
                });
        }
        
        $evaluations = $query->orderBy('created_at', 'desc')->paginate(12);
        
        if ($request->ajax()) {
            return view('admin.partials.evaluation_cards', compact('evaluations'))->render();
        }
        
        return view('admin.evaluation', compact('evaluations'));
    }
    public function delete($id)
    {
        $evaluation = Evaluation::findOrFail($id);
        $evaluation->delete();
        
        return redirect()->route('admin.Commentaire')->with('success', 'Le commentaire a été supprimé avec succès.');
    }
}