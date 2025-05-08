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
        
        $teachingSkills = Skill::all(); 
        $learningSkills = Skill::all(); 

        $id = $request->input('id');
        $name = $request->input('name');
        $campus = $request->input('campus');
        $teachSkill = $request->input('teachSkill');
        $learnSkill = $request->input('learnSkill');
        
        $etudiants = User::where('role', 'etudiant')
            ->with(['etudiant.teachingSkills', 'etudiant.learningSkills'])
            ->when($id, function ($query, $id) {
                $query->where('id', $id);
            })
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
            ->paginate(3); 

        return view('visiteure.search', compact('etudiants', 'teachingSkills', 'learningSkills'));
    }
}
