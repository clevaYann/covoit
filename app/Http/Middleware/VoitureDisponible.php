<?php

namespace App\Http\Middleware;

use App\Models\Employe;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VoitureDisponible
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $employe = Employe::find($request->route('id'));
        if (!$employe) {
            if ($request->expectsJson() || $request->is('api/*')) {
                return response()->json(['message' => 'Employe introuvable.'], 404);
            }

            return redirect()->route('employes.index')->with('error', 'Employe introuvable.');
        }

        if ($employe->voitures()->count() === 0) {
            if ($request->expectsJson() || $request->is('api/*')) {
                return response()->json([
                    'message' => 'Aucune voiture enregistree pour cet employe.',
                ], 403);
            }

            return redirect()->route('employes.ajouter-voiture', ['id' => $employe->id]);
        }
        
        return $next($request);
    }
}
