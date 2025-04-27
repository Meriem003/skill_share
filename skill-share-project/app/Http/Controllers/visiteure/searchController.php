<?php
namespace App\Http\Controllers\visiteure;
use App\Http\Controllers\Controller;
use App\Models\Skill;
use App\Models\User;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        // Récupérer toutes les compétences
        $teachingSkills = Skill::all(); // Représente les compétences à enseigner
        $learningSkills = Skill::all(); // Représente les compétences à apprendre

        // Récupérer les filtres de recherche
        $name = $request->input('name');
        $campus = $request->input('campus');
        $teachSkill = $request->input('teachSkill');
        $learnSkill = $request->input('learnSkill');

        // Requête pour récupérer les utilisateurs
        $etudiants = User::where('role', 'etudiant') // Filtrer uniquement les étudiants
            ->with(['etudiant.teachingSkills', 'etudiant.learningSkills']) // Inclure les relations teaching et learning skills
            ->when($name, function ($query, $name) {
                $query->where('fullname', 'LIKE', '%' . $name . '%');
            })
            ->when($campus, function ($query, $campus) {
                $query->where('campus', $campus);
            })
            ->when($teachSkill, function ($query, $teachSkill) {
                $query->whereHas('etudiant.teachingSkills', function ($subQuery) use ($teachSkill) {
                    $subQuery->where('nom', $teachSkill);
                });
            })
            ->when($learnSkill, function ($query, $learnSkill) {
                $query->whereHas('etudiant.learningSkills', function ($subQuery) use ($learnSkill) {
                    $subQuery->where('nom', $learnSkill);
                });
            })
            ->paginate(3); // Pagination avec 6 résultats par page

        // Retourner la vue avec les résultats et les compétences
        return view('visiteure.search', compact('etudiants', 'teachingSkills', 'learningSkills'));
    }
}