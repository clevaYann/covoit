<?php

namespace App\Http\Controllers;

use App\Models\Employe;
use Illuminate\Http\Request;

class EmployeController extends Controller
{
    // Récupérer tous les employés
    public function index()
    {
        $employe = Employe::all();
        return view('employes.index', compact('employe'));
    }

    // Récupérer un employé par ID
    public function show($id)
    {
        $employe = Employe::findOrFail($id);
        return view('employes.show', compact('employe'));
    }

    // Afficher le formulaire d'ajout de voiture pour un employé donné
    public function ajouterVoiture($id)
    {
        $employe = Employe::findOrFail($id);
        return view('employes.ajouter-voiture', compact('employe'));
    }

    // Créer un nouvel employé
    public function store(Request $request)
    {
        $new_employe = $request->validate([
            'nom' => 'required|string',
            'prenom' => 'required|string',
            'email' => 'required|email|unique:employes,email',
        ]);

        Employe::create($new_employe);
    }

    // Mettre à jour un employé
    public function update(Request $request, $id)
    {
        $employe = Employe::findOrFail($id);

        $updated_data = $request->validate([
            'nom' => 'sometimes|string',
            'prenom' => 'sometimes|string',
            'email' => 'sometimes|email|unique:employes,email,' . $id,
        ]);

        $employe->update($updated_data);
    }

    // Supprimer un employé
    public function destroy($id)
    {
        $employe = Employe::findOrFail($id);
        $employe->delete();
    }

    // Compter les voitures d'un employé
    public function compterVoitures($id)
    {
        $employe = Employe::findOrFail($id);

        return [
            'employe' => $employe->nom,
            'voiture_count' => $employe->voitures()->count(),
        ];
    }

    // Vérifier si l'employé possède un modèle de véhicule donné
    public function possedeModele(Request $request, $id)
    {
        $employe = Employe::findOrFail($id);

        $data = $request->validate([
            'modele' => 'required|string',
        ]);

        return [
            'employe' => $employe->nom,
            'modele' => $data['modele'],
            'possede' => $employe->possèdeModele($data['modele']),
        ];
    }

    // Retourner le statut conducteur de l'employé
    public function statutConducteur($id)
    {
        $employe = Employe::findOrFail($id);

        return [
            'employe' => $employe->nom,
            'statut' => $employe->statutConducteur(),
        ];
    }
}
