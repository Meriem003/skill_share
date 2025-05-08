<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Session;

class sessionController extends Controller
{
    public function index()
    {
        $sessions = Session::with(['teacher.user', 'student.user', 'skill'])->paginate(10);
        $sessionsWithoutTeacherOrStudent = $sessions->filter(function($session) {
            return $session->teacher_id === null || $session->student_id === null;
        });
    
        return view('admin.consuler-session', [
            'sessions' => $sessions,
            'sessionsWithoutTeacherOrStudent' => $sessionsWithoutTeacherOrStudent,
            'allSessions' => $sessions,
        ]);
    }
    
    public function delete($id)
    {
        $session = Session::findOrFail($id);
        $session->delete();
        
        return redirect()->route('admin.Session')->with('success', 'Session supprimée avec succès');
    }
}

