<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employe extends Model
{
    use HasFactory;

    protected $fillable = ['nom', 'prenom', 'email'];

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

    // Compter les voitures d'un employé
    public function compterVoitures(): int
    {
        return $this->voitures()->count();
    }

    // Vérifier si l'employé possède des véhicules d'un modèle particulier
    public function possèdeModele(string $modele): bool
    {
        return $this->voitures()->where('modele', $modele)->exists();
    }

    // Retourner le statut de l'employé selon le nombre de véhicules
    public function statutConducteur(): string
    {
        $nbVoitures = $this->compterVoitures();

        if ($nbVoitures === 0) {
            return 'Pas conducteur';
        }

        if ($nbVoitures === 1) {
            return 'Conducteur';
        }

        return 'Conducteur très actif';
    }
}
