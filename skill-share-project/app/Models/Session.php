<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    use HasFactory;
    protected $fillable = ['cours_id', 'titre', 'description', 'disponibilite'];

    public function cours()
    {
        return $this->belongsTo(Cours::class);
    }

    public function etudiants()
    {
        return $this->belongsToMany(Etudiant::class, 'sessions_suivies')
                    ->withTimestamp('date_suivi')
                    ->withTimestamps();
    }

    public function evaluations()
    {
        return $this->hasMany(Evaluation::class);
    }
}
