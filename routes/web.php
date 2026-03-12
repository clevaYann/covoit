<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeController;
use App\Http\Controllers\VehiculeController;

Route::get('/', function () {
    return view('welcome');
});

// Routes EmployeController
Route::prefix('employes')->group(function () {
    Route::get('/', [EmployeController::class, 'index']);
    Route::post('/', [EmployeController::class, 'store']);
    Route::get('/{id}', [EmployeController::class, 'show']);
    Route::put('/{id}', [EmployeController::class, 'update']);
    Route::delete('/{id}', [EmployeController::class, 'destroy']);
    Route::get('/{id}/compter-voitures', [EmployeController::class, 'compterVoitures']);
    Route::post('/{id}/possede-modele', [EmployeController::class, 'possedeModele']);
    Route::get('/{id}/statut', [EmployeController::class, 'statutConducteur']);
});

// Routes VehiculeController
Route::prefix('vehicules')->group(function () {
    Route::get('/', [VehiculeController::class, 'index']);
    Route::post('/', [VehiculeController::class, 'store']);
    Route::get('/{id}', [VehiculeController::class, 'show']);
    Route::put('/{id}', [VehiculeController::class, 'update']);
    Route::delete('/{id}', [VehiculeController::class, 'destroy']);
    Route::get('/rechercher/{modele}', [VehiculeController::class, 'rechercherParModele']);
    Route::get('/employe/{id_employe}', [VehiculeController::class, 'vehiculesParEmploye']);
});
