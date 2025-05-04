<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    use HasFactory;
    protected $fillable = ['session_id', 'auteur_id', 'evalue_id', 'note', 'commentaire', 'date_creation'];

    public function session()
    {
        return $this->belongsTo(Session::class);
    }

    public function evalue()
    {
        return $this->belongsTo(Etudiant::class, 'evalue_id');
    }

    public function auteur()
    {
        return $this->belongsTo(Etudiant::class, 'auteur_id');
    }
}