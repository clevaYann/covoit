<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trajet extends Model
{
    // Relation: Conduit (Le trajet appartient à une voiture)
    public function voiture()
    {
        return $this->belongsTo(Voiture::class);
    }

    // Relation: CampusDepart
    public function campusDepart()
    {
        return $this->belongsTo(Campuse::class, 'campus_depart_id');
    }

    // Relation: CampusArrive
    public function campusArrivee()
    {
        return $this->belongsTo(Campuse::class, 'campus_arrive_id');
    }

    // Relation: estPassager (Les employés qui participent au trajet)
    public function passagers()
    {
        return $this->belongsToMany(Employe::class, 'employe_trajet', 'trajet_id', 'employe_id')
            ->withPivot('date_inscription');
    }
}
