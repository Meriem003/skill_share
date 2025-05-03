<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tache extends Model
{
    use HasFactory;
    protected $fillable = [
        'titre', 
        'description', 
        'statut', 
        'categorie', 
        'date_limite',
        'todo_liste_id'
    ];
    protected $casts = [
        'date_limite' => 'date',
    ];

    public function todoListe()
    {
        return $this->belongsTo(ToDoListe::class, 'todo_liste_id');
    }
}
