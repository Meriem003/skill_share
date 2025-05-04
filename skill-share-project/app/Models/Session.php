<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    use HasFactory;

    protected $fillable = [
        'titre',
        'description',
        'disponibilite',
        'teacher_id',
        'student_id',
        'skill_id',
        'date_session',
        'duree',
        'lieu_type',
        'lieu_details',
        'statut',
        'commentaire_enseignant',
        'date_fin'
    ];

    public function teacher()
    {
        return $this->belongsTo(Etudiant::class, 'teacher_id');
    }

    public function student()
    {
        return $this->belongsTo(Etudiant::class, 'student_id');
    }

    public function skill()
    {
        return $this->belongsTo(Skill::class, 'skill_id');
    }

    public function etudiants()
    {
        return $this->belongsToMany(Etudiant::class, 'sessions_suivies')
                    ->withPivot('date_suivi')
                    ->withTimestamps();
    }

    public function evaluations()
    {
        return $this->hasMany(Evaluation::class);
    }
}
