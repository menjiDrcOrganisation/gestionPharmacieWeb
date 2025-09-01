<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Lot;
use App\Models\Pharmacie;
use App\Models\pharmacie_medicament;
use Illuminate\Http\Request;

use function Ramsey\Uuid\v1;

class LotController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       return response()->json(['message' => 'Not implemented'], 501);
        // try {
        //     $lots = Lot::all();
        //     return response()->json($lots, 200);
        // } catch (\Exception $e) {
        //     return response()->json(['error' => 'Failed to retrieve lots'], 500);
        // }
        // // --- IGNORE ---
        // return response()->json(['message' => 'Not implemented'], 501);
    }

    /**
     * Store a newly created resource in storage.
     */
   public function store(Request $request)
{
    try {
        // Validation des données
        $request->validate([
            "id_medicament" => "required|integer|exists:medicaments,id_medicament",
            "quantite" => "required|integer|min:1",
            "date_expiration" => "required|date|after:today",
            "prix_achat" => "required|numeric|min:0",
            "id_pharmacie" => "required|integer|exists:pharmacies,id_pharmacie",
        ]);

        // Récupérer la pharmacie
        $pharmacie = Pharmacie::find($request->id_pharmacie);

        if (!$pharmacie) {
            return response()->json(['error' => 'La pharmacie n\'existe pas'], 404);
        }

        // Vérifier si l'indice existe
        if ($pharmacie->indice === null) {
            return response()->json(['error' => 'L\'indice de la pharmacie est manquant'], 400);
        }

        // Calcul du prix unitaire (ici on utilise le prix d'achat, à ajuster si nécessaire)
        $prix_unitaire = $request->prix_achat * $pharmacie->indice / $request->quantite;

        // Générer un numéro de lot unique
        $numero_lot = uniqid('lot_');

        // Créer le lot
        $lot = Lot::create([
            "date_expiration" => $request->date_expiration,
            "quantite" => $request->quantite,
            "prix_achat" => $request->prix_achat,
            "prix_unitaire" => $prix_unitaire,
            "numero_lot" => $numero_lot,
            "id_pharmacie" => $request->id_pharmacie,
            "id_medicament" => $request->id_medicament
        ]);

        return response()->json($lot, 201);

    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
}

public function getlotspharmacie(string $id_pharmacie)
{
    try {
        // Récupérer les lots pour la pharmacie spécifiée
        $lots = Lot::where('id_pharmacie', $id_pharmacie)->get();

        if ($lots->isEmpty()) {
            return response()->json(['message' => 'Aucun lot trouvé pour cette pharmacie'], 404);
        }

        return response()->json($lots, 200);
    } catch (\Exception $e) {
        return response()->json(['error' => 'Failed to retrieve lots for the specified pharmacy'], 500);
    }
}

public function getlostmedicament(string $id_pharmacie, request $request)
{
    // Validation des données
    $request->validate([
        'id_medicament' => 'required|integer|exists:medicaments,id_medicament',
    ]);

    try {
        // Récupérer les lots pour le médicament spécifié dans la pharmacie
        $lots = Lot::where('id_pharmacie', $id_pharmacie)
            ->where('id_medicament', $request->id_medicament)
            ->get();

        if ($lots->isEmpty()) {
            return response()->json(['message' => 'Aucun lot trouvé pour ce médicament dans cette pharmacie'], 404);
        }

        return response()->json($lots, 200);
    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
}
    /**
     * Display the specified resource.
     */
   

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
