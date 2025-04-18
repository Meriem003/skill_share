<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    use HasFactory;
    protected $fillable = ['session_id', 'etudiant_id', 'note', 'commentaire', 'auteur_id'];

    public function session()
    {
        return $this->belongsTo(Session::class);
    }

    public function etudiant()
    {
        return $this->belongsTo(Etudiant::class, 'etudiant_id');
    }

    public function auteur()
    {
        return $this->belongsTo(Etudiant::class, 'auteur_id');
    }
}
