<?php

namespace App\Http\Middleware;

use App\Models\Voiture;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VoitureMoinsDeHuitPlaces
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $voiture = Voiture::find($request->route('id'));

        if (!$voiture) {
            if ($request->expectsJson() || $request->is('api/*')) {
                return response()->json(['message' => 'Voiture introuvable.'], 404);
            }

            return redirect()->route('employes.index')->with('error', 'Voiture introuvable.');
        }

        if ($voiture->nb_places >= 8) {
            if ($request->expectsJson() || $request->is('api/*')) {
                return response()->json(['message' => 'Visualisation des bus en cours'], 403);
            }

            return redirect()
                ->route('employes.show', ['id' => $voiture->employe_id])
                ->with('bus_message', 'Visualisation des bus en cours');
        }

        return $next($request);
    }
}
