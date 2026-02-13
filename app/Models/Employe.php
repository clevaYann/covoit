<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employe extends Model
{
    // Relation: estProprietaire (1 employé a plusieurs voitures)
    public function voitures()
    {
        return $this->hasMany(Voiture::class);
    }

    // Relation: Frequente (N employés <-> N campus)
    public function campuses()
    {
        return $this->belongsToMany(Campuse::class, 'campus_employe', 'employe_id', 'campus_id');
    }

    // Relation: estPassager (N employés <-> N trajets)
    public function trajets()
    {
        return $this->belongsToMany(Trajet::class, 'employe_trajet', 'employe_id', 'trajet_id')
            ->withPivot('date_inscription');
    }
}
