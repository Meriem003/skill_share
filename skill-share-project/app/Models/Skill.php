<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    use HasFactory;
    protected $fillable = ['nom', 'description'];

    public function etudiantsEnseignant()
    {
        return $this->belongsToMany(Etudiant::class, 'teaching_skills')
                    ->withTimestamps();
    }

    public function etudiantsApprenants()
    {
        return $this->belongsToMany(Etudiant::class, 'learning_skills')
                    ->withTimestamps();
    }
}