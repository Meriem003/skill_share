<?php
namespace App\Http\Controllers\etudiants;

use App\Models\Session;
use App\Models\Evaluation;
use App\Models\Skill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Http\Controllers\Controller;

class SessionsController extends Controller
{
    public function index()
    {
        $etudiant = Auth::user()->etudiant;
        
        $sessions = Session::where(function ($query) use ($etudiant) {
            $query->where('teacher_id', $etudiant->id)
                  ->orWhere('student_id', $etudiant->id);
        })
        ->with(['teacher.user', 'student.user', 'skill', 'evaluations'])
        ->orderBy('date_session', 'asc')
        ->get();
        
        return view('student.session', compact('sessions'));
    }

    public function cancel($id)
    {
        $session = Session::findOrFail($id);
        $etudiant = Auth::user()->etudiant;
        
        if ($session->teacher_id != $etudiant->id && $session->student_id != $etudiant->id) {
            return redirect()->back()->with('error', 'Vous n\'êtes pas autorisé à annuler cette session.');
        }
        
        if (in_array($session->statut, ['terminee', 'annule'])) {
            return redirect()->back()->with('error', 'Cette session ne peut plus être annulée.');
        }
        
        if (Carbon::parse($session->date_session)->isPast()) {
            return redirect()->back()->with('error', 'Vous ne pouvez pas annuler une session passée.');
        }
        
        $session->statut = 'annule';
        $session->save();
        
        return redirect()->back()->with('success', 'La session a été annulée avec succès.');
    }

    public function createEvaluation($sessionId)
    {
        $session = Session::with(['teacher.user', 'student.user', 'skill'])
                          ->findOrFail($sessionId);
        
        $etudiant = Auth::user()->etudiant;
        

        if ($session->teacher_id != $etudiant->id && $session->student_id != $etudiant->id) {
            return redirect()->route('sessions.index')->with('error', 'Vous n\'êtes pas autorisé à évaluer cette session.');
        }
        
        
        if ($session->statut != 'terminee') {
            return redirect()->route('sessions.index')->with('error', 'Vous ne pouvez évaluer que les sessions terminées.');
        }
        
        
        $existingEvaluation = Evaluation::where('session_id', $sessionId)
                                        ->where('auteur_id', $etudiant->id)
                                        ->first();
        
        if ($existingEvaluation) {
            return redirect()->route('sessions.index')->with('error', 'Vous avez déjà évalué cette session.');
        }
        
        return view('student.évaluer', compact('session'));
    }

    public function storeEvaluation(Request $request, $sessionId)
    {
        $session = Session::findOrFail($sessionId);
        $etudiant = Auth::user()->etudiant;
        
        
        if ($session->teacher_id != $etudiant->id && $session->student_id != $etudiant->id) {
            return redirect()->route('sessions.index')->with('error', 'Vous n\'êtes pas autorisé à évaluer cette session.');
        }
        
        if ($session->statut != 'terminee') {
            return redirect()->route('sessions.index')->with('error', 'Vous ne pouvez évaluer que les sessions terminées.');
        }
        
        $existingEvaluation = Evaluation::where('session_id', $sessionId)
                                        ->where('auteur_id', $etudiant->id)
                                        ->first();
        
        if ($existingEvaluation) {
            return redirect()->route('sessions.index')->with('error', 'Vous avez déjà évalué cette session.');
        }

        $validated = $request->validate([
            'note' => 'required|integer|min:1|max:5',
            'commentaire' => 'required|string|min:10|max:500',
        ]);
        
        $evaluatedId = ($etudiant->id == $session->teacher_id) ? $session->student_id : $session->teacher_id;
        

        $evaluation = new Evaluation();
        $evaluation->session_id = $sessionId;
        $evaluation->auteur_id = $etudiant->id;
        $evaluation->evalue_id = $evaluatedId;
        $evaluation->note = $validated['note'];
        $evaluation->commentaire = $validated['commentaire'];
        $evaluation->date_creation = Carbon::now();
        $evaluation->save();
        
        return redirect()->route('sessions.index')->with('success', 'Votre évaluation a été enregistrée avec succès.');
    }
    public function accept($id)
    {
        $session = Session::findOrFail($id);
        $etudiant = Auth::user()->etudiant;
        
        if ($session->teacher_id != $etudiant->id) {
            return redirect()->back()->with('error', 'Vous n\'êtes pas autorisé à accepter cette session.');
        }
        
        if ($session->statut != 'en_attente') {
            return redirect()->back()->with('error', 'Cette session ne peut pas être acceptée.');
        }
        
        $session->statut = 'accepte';
        $session->save();
        
        return redirect()->back()->with('success', 'La session a été acceptée avec succès.');
    }

    public function reject($id)
    {
        $session = Session::findOrFail($id);
        $etudiant = Auth::user()->etudiant;

        if ($session->teacher_id != $etudiant->id) {
            return redirect()->back()->with('error', 'Vous n\'êtes pas autorisé à refuser cette session.');
        }

        if ($session->statut != 'en_attente') {
            return redirect()->back()->with('error', 'Cette session ne peut pas être refusée.');
        }
        
        $session->statut = 'refuse';
        $session->save();
        
        return redirect()->back()->with('success', 'La session a été refusée.');
    }
    public function complete($id)
    {
        $session = Session::findOrFail($id);
        $etudiant = Auth::user()->etudiant;

        if ($session->teacher_id != $etudiant->id && $session->student_id != $etudiant->id) {
            return redirect()->back()->with('error', 'Vous n\'êtes pas autorisé à terminer cette session.');
        }
        if ($session->statut != 'accepte') {
            return redirect()->back()->with('error', 'Seules les sessions acceptées peuvent être marquées comme terminées.');
        }
        
        $session->statut = 'terminee';
        $session->save();
        
        return redirect()->back()->with('success', 'La session a été marquée comme terminée.');
    }
    public function create($teacherId = null)
    {
        $skills = Skill::orderBy('nom')->get();
        $teacherId = $teacherId ?? null;
        
        return view('sessions.create', compact('skills', 'teacherId'));
    }
    public function store(Request $request)
    {
        $etudiant = Auth::user()->etudiant;
        $validated = $request->validate([
            'titre' => 'required|string|max:100',
            'teacher_id' => 'required|exists:etudiants,id',
            'skill_id' => 'required|exists:skills,id',
            'date_session' => 'required|date|after:now',
            'duree' => 'required|integer|min:15|max:240',
            'lieu_type' => 'required|in:campus,en_ligne,autre',
            'lieu_details' => 'required|string|max:255',
            'description' => 'nullable|string|max:500',
        ]);
        
        $session = new Session();
        $session->titre = $validated['titre'];
        $session->teacher_id = $validated['teacher_id'];
        $session->student_id = $etudiant->id; 
        $session->skill_id = $validated['skill_id'];
        $session->date_session = $validated['date_session'];
        $session->duree = $validated['duree'];
        $session->lieu_type = $validated['lieu_type'];
        $session->lieu_details = $validated['lieu_details'];
        $session->description = $validated['description'] ?? null;
        $session->statut = 'en_attente';
        $session->date_creation = Carbon::now();
        $session->save();
        
        return redirect()->route('sessions.index')->with('success', 'Votre demande de session a été envoyée avec succès.');
    }

    public function show($id)
    {
        $session = Session::with(['teacher.user', 'student.user', 'skill', 'evaluations.auteur.user'])
                          ->findOrFail($id);
        
        $etudiant = Auth::user()->etudiant;
        
        if ($session->teacher_id != $etudiant->id && $session->student_id != $etudiant->id) {
            return redirect()->route('sessions.index')->with('error', 'Vous n\'êtes pas autorisé à voir cette session.');
        }
        
        return view('sessions.show', compact('session'));
    }
}