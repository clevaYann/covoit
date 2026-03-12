<?php

namespace App\Http\Controllers;

use App\Models\Voiture;
use Illuminate\Http\Request;

class VehiculeController extends Controller
{
    // Récupérer tous les véhicules
    public function index()
    {
        $voitures = Voiture::all();
        return $voitures;
    }

    // Récupérer un véhicule par ID
    public function show($id)
    {
        $voiture = Voiture::findOrFail($id);
        return $voiture;
    }

    // Créer un nouveau véhicule
    public function store(Request $request)
    {
        $new_voiture = $request->validate([
            'modele' => 'required|string',
            'nb_places' => 'required|integer',
            'employe_id' => 'required|exists:employes,id',
        ]);

        Voiture::create($new_voiture);
    }

    // Mettre à jour un véhicule
    public function update(Request $request, $id)
    {
        $voiture = Voiture::findOrFail($id);

        $updated_data = $request->validate([
            'modele' => 'sometimes|string',
            'nb_places' => 'sometimes|integer',
            'employe_id' => 'sometimes|exists:employes,id',
        ]);

        $voiture->update($updated_data);
    }

    // Supprimer un véhicule
    public function destroy($id)
    {
        $voiture = Voiture::findOrFail($id);
        $voiture->delete();
    }

    // Fonction supplémentaire 1 : Rechercher les véhicules par modèle
    public function rechercherParModele($modele)
    {
        $voitures = Voiture::where('modele', $modele)->get();

        return [
            'modele' => $modele,
            'nombre_resultats' => $voitures->count(),
            'voitures' => $voitures,
        ];
    }

    // Fonction supplémentaire 2 : Compter les véhicules d'un employé
    public function vehiculesParEmploye($id_employe)
    {
        $voitures = Voiture::where('employe_id', $id_employe)->get();

        return [
            'employe_id' => $id_employe,
            'nombre_vehicules' => $voitures->count(),
            'voitures' => $voitures,
        ];
    }
}
