<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class courses extends Model
{
    use HasFactory;

    protected $fillable = [
        'titre',
        'description',
        'image_path',
        'etudiant_id',
    ];

    // Relation avec un étudiant (1 cours -> 1 étudiant)
    public function etudiant()
    {
        return $this->belongsTo(Etudiant::class);
    }
}