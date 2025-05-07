<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Session;

class sessionController extends Controller
{
    public function index()
    {
        // Fetch all sessions
        $sessions = Session::with(['teacher.user', 'student.user', 'skill'])->get();
        
        // Filter sessions without teacher or student if needed
        $sessionsWithoutTeacherOrStudent = $sessions->filter(function($session) {
            return $session->teacher_id === null || $session->student_id === null;
        });
        
        // Get all sessions with teacher and student for reference
        $allSessions = $sessions;
        
        return view('admin.consuler-session', [
            'sessions' => $sessions,
            'sessionsWithoutTeacherOrStudent' => $sessionsWithoutTeacherOrStudent,
            'allSessions' => $allSessions
        ]);
    }
    
    public function show($id)
    {
        $session = Session::with(['teacher.user', 'student.user', 'skill'])->findOrFail($id);
        return view('admin.sessions.show', compact('session'));
    }
    
    public function delete($id)
    {
        $session = Session::findOrFail($id);
        $session->delete();
        
        return redirect()->route('admin.Session')->with('success', 'Session supprimée avec succès');
    }
}

