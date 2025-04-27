<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\courses;
use App\Models\Skill;
use App\Models\Session;
use App\Models\Badge;
use App\Models\ToDoListe;
use App\Models\Evaluation;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
                    ->withPivot('date_suivi') // Corrected method name
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

    public function evaluationsDonnees(): HasMany
    {
        return $this->hasMany(Evaluation::class, 'auteur_id');
    }

    // Relation avec les cours (1 étudiant -> plusieurs cours)
    public function courses()
    {
        return $this->hasMany(courses::class); // Use 'Cours' model
    }
}