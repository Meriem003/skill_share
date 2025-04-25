<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Etudiant extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'rang'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function badges()
    {
        return $this->belongsToMany(Badge::class, 'etudiant_badge')
                    ->withPivot('date_obtention') // Include the 'date_obtention' column from the pivot table
                    ->withTimestamps();
    }
    public function teachingSkills()
    {
        return $this->belongsToMany(Skill::class, 'teaching_skills')
                    ->withTimestamps();
    }

    public function learningSkills()
    {
        return $this->belongsToMany(Skill::class, 'learning_skills')
                    ->withTimestamps();
    }

    public function sessionsSuivies()
    {
        return $this->belongsToMany(Session::class, 'sessions_suivies')
                    ->withTimestamp('date_suivi')
                    ->withTimestamps();
    }
    public function todoListes()
    {
        return $this->hasMany(ToDoListe::class);
    }

    public function evaluationsRecues()
    {
        return $this->hasMany(Evaluation::class, 'etudiant_id');
    }

    public function evaluationsDonnees()
    {
        return $this->hasMany(Evaluation::class, 'auteur_id');
    }
}


