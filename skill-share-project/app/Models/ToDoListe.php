<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ToDoListe extends Model
{
    use HasFactory;
    protected $fillable = ['etudiant_id', 'titre'];

    // Explicitly specify the table name to avoid case-sensitivity issues
    protected $table = 'todo_listes';

    public function etudiant()
    {
        return $this->belongsTo(Etudiant::class);
    }

    public function taches()
    {
        return $this->hasMany(Tache::class, 'todo_liste_id');
    }
}
