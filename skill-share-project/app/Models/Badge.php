<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Badge extends Model
{
    use HasFactory;
    protected $fillable = ['nom', 'description', 'image_path'];

    public function etudiants()
    {
        return $this->belongsToMany(Etudiant::class, 'etudiant_badge')
                    ->withTimestamp('date_obtention')
                    ->withTimestamps();
    }
}
