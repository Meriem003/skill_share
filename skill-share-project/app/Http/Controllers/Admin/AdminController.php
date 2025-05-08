<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Session;
use App\Models\Evaluation;
use App\Models\Badge;
use App\Models\Skill;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index()
    {
        $stats = [
            'users_count' => User::count(),
            'sessions_count' => Session::where('statut', 'terminee')->count(),
            'average_rating' => Evaluation::avg('note') ?? 0,
            'badges_count' => DB::table('etudiant_badge')->count(),
            'popular_skills' => $this->getPopularSkills(),
        ];
        return view('admin.dashboard', compact('stats'));
    }
    private function getPopularSkills()
    {
        $skills = Skill::select('skills.id', 'skills.nom', DB::raw('COUNT(sessions.id) as sessions_count'))
            ->leftJoin('sessions', 'skills.id', '=', 'sessions.skill_id')
            ->groupBy('skills.id', 'skills.nom')
            ->orderByDesc('sessions_count')
            ->limit(10)
            ->get();
        $maxCount = $skills->max('sessions_count') ?: 1;
        foreach ($skills as $skill) {
            $skill->percentage = ($skill->sessions_count / $maxCount) * 100;
        }
        return $skills;
    }
}