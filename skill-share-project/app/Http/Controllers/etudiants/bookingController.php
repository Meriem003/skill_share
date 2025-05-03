<?php

namespace App\Http\Controllers\etudiants;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Etudiant;
use App\Models\Session;
use App\Models\Skill;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class BookingController extends Controller
{
    public function index(Request $request)
    {
        $teacherId = $request->query('teacher_id');
        $teacher = null;
        
        // Si un ID d'enseignant est fourni, récupérer ses informations
        if ($teacherId) {
            $teacher = Etudiant::with(['user', 'teachingSkills'])->find($teacherId);
            
            if (!$teacher) {
                return redirect()->route('search')
                    ->with('error', 'Enseignant non trouvé.');
            }
        }
        
        // Récupérer tous les étudiants qui ont des compétences à enseigner
        $teachers = Etudiant::whereHas('teachingSkills')->with('user')->get();
        
        // Récupérer toutes les compétences disponibles
        $skills = Skill::all();
        
        return view('student.booking', compact('teacher', 'teachers', 'skills'));
    }
    
    public function store(Request $request)
    {
        // Valider les données du formulaire
        $validatedData = $request->validate([
            'teacher_id' => 'required|exists:etudiants,id',
            'skill_id' => 'required|exists:skills,id',
            'titre' => 'required|string|max:255',
            'description' => 'required|string',
            'date_session' => 'required|date|after_or_equal:today',
            'heure_session' => 'required',
            'duree' => 'required|integer|min:30|max:240',
            'lieu_type' => 'required|string|in:campus,en_ligne,autre',
            'campus_salle' => 'nullable|string|max:100',
            'online_link' => 'nullable|url|max:255',
            'autre_lieu' => 'nullable|string|max:255',
        ]);
        
        // Récupérer l'étudiant connecté
        $etudiant = Auth::user()->etudiant;
        
        // Créer une nouvelle session
        $session = new Session();
        $session->titre = $validatedData['titre'];
        $session->description = $validatedData['description'];
        
        // Combiner la date et l'heure
        $dateHeure = Carbon::createFromFormat(
            'Y-m-d H:i', 
            $validatedData['date_session'] . ' ' . $validatedData['heure_session']
        );
        
        // Ajouter les informations de base à la session
        $session->date_session = $dateHeure;
        $session->duree = $validatedData['duree'];
        $session->lieu_type = $validatedData['lieu_type'];
        
        // Stocker les détails du lieu en fonction du type sélectionné
        switch ($validatedData['lieu_type']) {
            case 'campus':
                $session->lieu_details = $validatedData['campus_salle'] ?? 'Campus (salle à confirmer)';
                break;
            case 'en_ligne':
                $session->lieu_details = $validatedData['online_link'] ?? 'Lien de réunion à confirmer';
                break;
            case 'autre':
                $session->lieu_details = $validatedData['autre_lieu'] ?? 'Lieu à confirmer';
                break;
        }
        
        // Statut par défaut: en attente
        $session->statut = 'en_attente';
        
        // ID de l'étudiant qui enseigne et de l'étudiant qui apprend
        $session->teacher_id = $validatedData['teacher_id'];
        $session->student_id = $etudiant->id;
        
        // ID de la compétence concernée
        $session->skill_id = $validatedData['skill_id'];
        
        // Enregistrer la session
        $session->save();
        
        // Rediriger avec un message de succès
        return redirect()->route('etudiant.dashboard')
            ->with('success', 'Votre demande de session a été envoyée avec succès. Vous serez notifié lorsque l\'enseignant y répondra.');
    }

    public function show($id)
    {
        $session = Session::with(['teacher.user', 'student.user', 'skill'])->findOrFail($id);
        
        // Vérifier que l'utilisateur connecté est bien lié à cette session
        $etudiant = Auth::user()->etudiant;
        if ($session->teacher_id !== $etudiant->id && $session->student_id !== $etudiant->id) {
            return redirect()->route('etudiant.dashboard')
                ->with('error', 'Vous n\'êtes pas autorisé à voir cette session.');
        }
        
        return view('student.session_details', compact('session'));
    }
    
    public function update(Request $request, $id)
    {
        $session = Session::findOrFail($id);
        $etudiant = Auth::user()->etudiant;
        
        // Vérifier que l'utilisateur est l'enseignant de cette session
        if ($session->teacher_id !== $etudiant->id) {
            return redirect()->route('etudiant.dashboard')
                ->with('error', 'Vous n\'êtes pas autorisé à modifier cette session.');
        }
        
        // Valider les données du formulaire
        $validatedData = $request->validate([
            'statut' => 'required|string|in:accepte,refuse',
            'commentaire' => 'nullable|string',
            'lieu_details' => 'nullable|string|max:255',
        ]);
        
        // Mettre à jour le statut de la session
        $session->statut = $validatedData['statut'];
        
        if (isset($validatedData['commentaire'])) {
            $session->commentaire_enseignant = $validatedData['commentaire'];
        }
        
        // Mettre à jour les détails du lieu si fournis
        if (isset($validatedData['lieu_details'])) {
            $session->lieu_details = $validatedData['lieu_details'];
        }
        
        $session->save();
        
        // Rediriger avec un message de succès
        return redirect()->route('etudiant.dashboard')
            ->with('success', 'La session a été mise à jour avec succès.');
    }
    
    public function complete(Request $request, $id)
    {
        $session = Session::findOrFail($id);
        $etudiant = Auth::user()->etudiant;
        
        // Vérifier que l'utilisateur est lié à cette session
        if ($session->teacher_id !== $etudiant->id && $session->student_id !== $etudiant->id) {
            return redirect()->route('etudiant.dashboard')
                ->with('error', 'Vous n\'êtes pas autorisé à modifier cette session.');
        }
        
        // Vérifier que la session est acceptée
        if ($session->statut !== 'accepte') {
            return redirect()->route('etudiant.dashboard')
                ->with('error', 'Cette session n\'est pas en cours.');
        }
        
        // Marquer la session comme terminée
        $session->statut = 'terminee';
        $session->date_fin = Carbon::now();
        $session->save();
        
        // Ajouter la relation dans sessions_suivies
        DB::table('sessions_suivies')->insert([
            'etudiant_id' => $session->student_id,
            'session_id' => $session->id,
            'date_suivi' => Carbon::now(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        
        // Rediriger avec un message de succès
        return redirect()->route('etudiant.dashboard')
            ->with('success', 'La session a été marquée comme terminée.');
    }
}