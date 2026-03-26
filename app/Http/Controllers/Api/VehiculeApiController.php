<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Voiture;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use OpenApi\Attributes as OA;

class VehiculeApiController extends Controller
{
    #[OA\Get(path: '/api/vehicules', tags: ['Vehicules'], summary: 'Lister les vehicules', responses: [new OA\Response(response: 200, description: 'Liste des vehicules')])]
    public function index(Request $request): JsonResponse
    {
        $query = Voiture::with('employe');

        if ($request->filled('modele')) {
            $query->where('modele', 'like', '%' . $request->string('modele') . '%');
        }

        if ($request->filled('employe_id')) {
            $query->where('employe_id', $request->integer('employe_id'));
        }

        $voitures = $query->get();

        return response()->json($voitures);
    }

    #[OA\Get(path: '/api/vehicules/{id}', tags: ['Vehicules'], summary: 'Afficher un vehicule', parameters: [new OA\Parameter(name: 'id', in: 'path', required: true, schema: new OA\Schema(type: 'integer'))], responses: [new OA\Response(response: 200, description: 'Vehicule trouve'), new OA\Response(response: 403, description: 'Visualisation des bus en cours')])]
    public function show(int $id): JsonResponse
    {
        $voiture = Voiture::with('employe')->findOrFail($id);

        return response()->json($voiture);
    }

    #[OA\Post(path: '/api/vehicules', tags: ['Vehicules'], summary: 'Creer un vehicule', responses: [new OA\Response(response: 201, description: 'Vehicule cree'), new OA\Response(response: 422, description: 'Validation echouee')])]
    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'modele' => 'required|string',
            'nb_places' => 'required|integer',
            'employe_id' => 'required|exists:employes,id',
        ]);

        $voiture = Voiture::create($data);

        return response()->json([
            'message' => 'Vehicule cree avec succes.',
            'data' => $voiture,
        ], 201);
    }

    #[OA\Put(path: '/api/vehicules/{id}', tags: ['Vehicules'], summary: 'Mettre a jour completement un vehicule', parameters: [new OA\Parameter(name: 'id', in: 'path', required: true, schema: new OA\Schema(type: 'integer'))], responses: [new OA\Response(response: 200, description: 'Vehicule mis a jour')])]
    public function update(Request $request, int $id): JsonResponse
    {
        $voiture = Voiture::findOrFail($id);

        $data = $request->validate([
            'modele' => 'required|string',
            'nb_places' => 'required|integer',
            'employe_id' => 'required|exists:employes,id',
        ]);

        $voiture->update($data);

        return response()->json($voiture->fresh());
    }

    #[OA\Patch(path: '/api/vehicules/{id}', tags: ['Vehicules'], summary: 'Mettre a jour partiellement un vehicule', parameters: [new OA\Parameter(name: 'id', in: 'path', required: true, schema: new OA\Schema(type: 'integer'))], responses: [new OA\Response(response: 200, description: 'Vehicule mis a jour partiellement')])]
    public function partialUpdate(Request $request, int $id): JsonResponse
    {
        $voiture = Voiture::findOrFail($id);

        $data = $request->validate([
            'modele' => 'sometimes|string',
            'nb_places' => 'sometimes|integer',
            'employe_id' => 'sometimes|exists:employes,id',
        ]);

        $voiture->update($data);

        return response()->json($voiture->fresh());
    }

    #[OA\Delete(path: '/api/vehicules/{id}', tags: ['Vehicules'], summary: 'Supprimer un vehicule', parameters: [new OA\Parameter(name: 'id', in: 'path', required: true, schema: new OA\Schema(type: 'integer'))], responses: [new OA\Response(response: 204, description: 'Vehicule supprime')])]
    public function destroy(int $id): JsonResponse
    {
        $voiture = Voiture::findOrFail($id);
        $voiture->delete();

        return response()->json(null, 204);
    }

    #[OA\Get(path: '/api/vehicules/rechercher/{modele}', tags: ['Vehicules'], summary: 'Rechercher des vehicules par modele', parameters: [new OA\Parameter(name: 'modele', in: 'path', required: true, schema: new OA\Schema(type: 'string'))], responses: [new OA\Response(response: 200, description: 'Resultats de recherche')])]
    public function rechercherParModele(string $modele): JsonResponse
    {
        $voitures = Voiture::where('modele', $modele)->get();

        return response()->json([
            'modele' => $modele,
            'nombre_resultats' => $voitures->count(),
            'voitures' => $voitures,
        ]);
    }

    #[OA\Get(path: '/api/vehicules/employe/{id_employe}', tags: ['Vehicules'], summary: 'Lister les vehicules d un employe', parameters: [new OA\Parameter(name: 'id_employe', in: 'path', required: true, schema: new OA\Schema(type: 'integer'))], responses: [new OA\Response(response: 200, description: 'Vehicules de l employe')])]
    public function vehiculesParEmploye(int $id_employe): JsonResponse
    {
        $voitures = Voiture::where('employe_id', $id_employe)->get();

        return response()->json([
            'employe_id' => $id_employe,
            'nombre_vehicules' => $voitures->count(),
            'voitures' => $voitures,
        ]);
    }
}
