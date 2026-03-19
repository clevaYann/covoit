<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voiture extends Model
{
    use HasFactory;

    protected $fillable = ['modele', 'nb_places', 'employe_id'];

    // Relation: estProprietaire (L'employé qui possède la voiture)
    public function employe()
    {
        return $this->belongsTo(Employe::class, 'employe_id');
    }

    // Relation: Conduit (Une voiture est utilisée pour plusieurs trajets)
    public function trajets()
    {
        return $this->hasMany(Trajet::class);
    }
}
