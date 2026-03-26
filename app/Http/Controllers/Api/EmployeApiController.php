<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Employe;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use OpenApi\Attributes as OA;

class EmployeApiController extends Controller
{
    #[OA\Get(path: '/api/employes', tags: ['Employes'], summary: 'Lister les employes', responses: [new OA\Response(response: 200, description: 'Liste des employes')])]
    public function index(Request $request): JsonResponse
    {
        $query = Employe::with(['campuses', 'voitures']);

        if ($request->filled('nom')) {
            $query->where('nom', 'like', '%' . $request->string('nom') . '%');
        }

        if ($request->filled('email')) {
            $query->where('email', 'like', '%' . $request->string('email') . '%');
        }

        $employes = $query->get();

        return response()->json($employes);
    }

    #[OA\Get(path: '/api/employes/{id}', tags: ['Employes'], summary: 'Afficher un employe', parameters: [new OA\Parameter(name: 'id', in: 'path', required: true, schema: new OA\Schema(type: 'integer'))], responses: [new OA\Response(response: 200, description: 'Employe trouve'), new OA\Response(response: 403, description: 'Regle metier bloquee'), new OA\Response(response: 404, description: 'Employe introuvable')])]
    public function show(int $id): JsonResponse
    {
        $employe = Employe::with(['campuses', 'voitures'])->findOrFail($id);

        return response()->json($employe);
    }

    #[OA\Post(path: '/api/employes', tags: ['Employes'], summary: 'Creer un employe', responses: [new OA\Response(response: 201, description: 'Employe cree'), new OA\Response(response: 422, description: 'Validation echouee')])]
    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'nom' => 'required|string',
            'prenom' => 'required|string',
            'email' => 'required|email|unique:employes,email',
        ]);

        $employe = Employe::create($data);

        return response()->json([
            'message' => 'Employe cree avec succes.',
            'data' => $employe,
        ], 201);
    }

    #[OA\Put(path: '/api/employes/{id}', tags: ['Employes'], summary: 'Mettre a jour completement un employe', parameters: [new OA\Parameter(name: 'id', in: 'path', required: true, schema: new OA\Schema(type: 'integer'))], responses: [new OA\Response(response: 200, description: 'Employe mis a jour'), new OA\Response(response: 422, description: 'Validation echouee')])]
    public function update(Request $request, int $id): JsonResponse
    {
        $employe = Employe::findOrFail($id);

        $data = $request->validate([
            'nom' => 'required|string',
            'prenom' => 'required|string',
            'email' => 'required|email|unique:employes,email,' . $id,
        ]);

        $employe->update($data);

        return response()->json($employe->fresh());
    }

    #[OA\Patch(path: '/api/employes/{id}', tags: ['Employes'], summary: 'Mettre a jour partiellement un employe', parameters: [new OA\Parameter(name: 'id', in: 'path', required: true, schema: new OA\Schema(type: 'integer'))], responses: [new OA\Response(response: 200, description: 'Employe mis a jour partiellement'), new OA\Response(response: 422, description: 'Validation echouee')])]
    public function partialUpdate(Request $request, int $id): JsonResponse
    {
        $employe = Employe::findOrFail($id);

        $data = $request->validate([
            'nom' => 'sometimes|string',
            'prenom' => 'sometimes|string',
            'email' => 'sometimes|email|unique:employes,email,' . $id,
        ]);

        $employe->update($data);

        return response()->json($employe->fresh());
    }

    #[OA\Delete(path: '/api/employes/{id}', tags: ['Employes'], summary: 'Supprimer un employe', parameters: [new OA\Parameter(name: 'id', in: 'path', required: true, schema: new OA\Schema(type: 'integer'))], responses: [new OA\Response(response: 204, description: 'Employe supprime'), new OA\Response(response: 404, description: 'Employe introuvable')])]
    public function destroy(int $id): JsonResponse
    {
        $employe = Employe::findOrFail($id);
        $employe->delete();

        return response()->json(null, 204);
    }

    #[OA\Get(path: '/api/employes/{id}/compter-voitures', tags: ['Employes'], summary: 'Compter les voitures d un employe', parameters: [new OA\Parameter(name: 'id', in: 'path', required: true, schema: new OA\Schema(type: 'integer'))], responses: [new OA\Response(response: 200, description: 'Nombre de voitures')])]
    public function compterVoitures(int $id): JsonResponse
    {
        $employe = Employe::findOrFail($id);

        return response()->json([
            'employe' => $employe->nom,
            'voiture_count' => $employe->voitures()->count(),
        ]);
    }

    #[OA\Post(path: '/api/employes/{id}/possede-modele', tags: ['Employes'], summary: 'Verifier si l employe possede un modele', parameters: [new OA\Parameter(name: 'id', in: 'path', required: true, schema: new OA\Schema(type: 'integer'))], responses: [new OA\Response(response: 200, description: 'Resultat de verification')])]
    public function possedeModele(Request $request, int $id): JsonResponse
    {
        $employe = Employe::findOrFail($id);

        $data = $request->validate([
            'modele' => 'required|string',
        ]);

        return response()->json([
            'employe' => $employe->nom,
            'modele' => $data['modele'],
            'possede' => $employe->possèdeModele($data['modele']),
        ]);
    }

    #[OA\Get(path: '/api/employes/{id}/statut', tags: ['Employes'], summary: 'Obtenir le statut conducteur', parameters: [new OA\Parameter(name: 'id', in: 'path', required: true, schema: new OA\Schema(type: 'integer'))], responses: [new OA\Response(response: 200, description: 'Statut conducteur')])]
    public function statutConducteur(int $id): JsonResponse
    {
        $employe = Employe::findOrFail($id);

        return response()->json([
            'employe' => $employe->nom,
            'statut' => $employe->statutConducteur(),
        ]);
    }
}
