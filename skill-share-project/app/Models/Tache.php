<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tache extends Model
{
    use HasFactory;
    protected $fillable = ['todo_liste_id', 'titre', 'description', 'statut', 'date_limite'];

    protected $casts = [
        'date_limite' => 'date',
    ];

    public function todoListe()
    {
        return $this->belongsTo(ToDoListe::class, 'todo_liste_id');
    }
}
