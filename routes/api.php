<?php

use App\Http\Controllers\Api\EmployeApiController;
use App\Http\Controllers\Api\VehiculeApiController;
use Illuminate\Support\Facades\Route;

Route::prefix('employes')->group(function () {
    Route::get('/', [EmployeApiController::class, 'index']);
    Route::post('/', [EmployeApiController::class, 'store']);
    Route::get('/{id}', [EmployeApiController::class, 'show'])
        ->middleware(['campus.disponible', 'voiture.disponible']);
    Route::put('/{id}', [EmployeApiController::class, 'update']);
    Route::patch('/{id}', [EmployeApiController::class, 'partialUpdate']);
    Route::delete('/{id}', [EmployeApiController::class, 'destroy']);
    Route::get('/{id}/compter-voitures', [EmployeApiController::class, 'compterVoitures']);
    Route::post('/{id}/possede-modele', [EmployeApiController::class, 'possedeModele']);
    Route::get('/{id}/statut', [EmployeApiController::class, 'statutConducteur']);
});

Route::prefix('vehicules')->group(function () {
    Route::get('/', [VehiculeApiController::class, 'index']);
    Route::post('/', [VehiculeApiController::class, 'store']);
    Route::get('/{id}', [VehiculeApiController::class, 'show'])->middleware('voiture.moins.huit');
    Route::put('/{id}', [VehiculeApiController::class, 'update']);
    Route::patch('/{id}', [VehiculeApiController::class, 'partialUpdate']);
    Route::delete('/{id}', [VehiculeApiController::class, 'destroy']);
    Route::get('/rechercher/{modele}', [VehiculeApiController::class, 'rechercherParModele']);
    Route::get('/employe/{id_employe}', [VehiculeApiController::class, 'vehiculesParEmploye']);
});
