<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Campuse extends Model
{
    // Relation: Frequente (N campus <-> N employés)
    public function employes()
    {
        return $this->belongsToMany(Employe::class, 'campus_employe', 'campus_id', 'employe_id');
    }

    // Relation: Départs depuis ce campus
    public function trajetsDepart()
    {
        return $this->hasMany(Trajet::class, 'campus_depart_id');
    }

    // Relation: Arrivées vers ce campus
    public function trajetsArrivee()
    {
        return $this->hasMany(Trajet::class, 'campus_arrive_id');
    }
}
