<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Dose;
use App\Models\Formes;
use App\Models\Lot;
use App\Models\Medicament;
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
    try {
        $lots = Lot::all();
        return response()->json($lots, 200);
    } catch (\Exception $e) {
        return response()->json(['error' => 'Failed to retrieve lots'], 500);
    }
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
            "prix_achat" => "required|integer|min:0",
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
        // Récupérer les lots avec les informations du médicament
        $lots = Lot::with('medicament')
            ->where('id_pharmacie', $id_pharmacie)
            ->get();

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
    public function setprixunitaire(Request $request, string $id)
    {
        try {
            // Validation des données
            $request->validate([
                "prix_unitaire" => "required|numeric|min:0",
            ]);

            // Récupérer le lot
            $lot = Lot::findOrFail($id);

            // Mettre à jour le prix unitaire
            $lot->prix_unitaire = $request->prix_unitaire;

            // Enregistrer les modifications
            $lot->save();

            return response()->json($lot, 201);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to update unit price: ' . $e->getMessage()], 500);
        }
    }
    public function update(Request $request, string $id)
    {
      try{
        // Validation des données
        $request->validate([
            "quantite" => "required|integer|min:1",
            "date_expiration" => "required|date|after:today",
            "prix_achat" => "required|numeric|min:0",
        ]);

        // Récupérer le lot
        $lot = Lot::findOrFail($id);

        // Mettre à jour les informations du lot
        $lot->quantite = $request->quantite;
        $lot->date_expiration = $request->date_expiration;
        $lot->prix_achat = $request->prix_achat;

        // Calculer le prix unitaire
        $pharmacie = Pharmacie::find($lot->id_pharmacie);
        if ($pharmacie) {
            $lot->prix_unitaire = $request->prix_achat * $pharmacie->indice / $lot->quantite;
        }

        // Enregistrer les modifications
        $lot->save();

        return response()->json($lot, 201);

      }
      catch (\Exception $e){
        return response ()->json(['error'=>$e->getMessage(),500]);
      }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            // Récupérer le lot
            $lot = Lot::findOrFail($id);

            // Supprimer le lot
            $lot->delete();

            return response()->json(['message' => 'Lot deleted successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to delete lot: ' . $e->getMessage()], 500);
        }
    }
    public function getallformeanddose(){
        try {
         $forme = Formes::all();
        $dose = Dose::all();
        return response()->json(['forme'=>$forme,'dose'=>$dose],200);

        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to retrieve formes'], 500);
    }
}
    public function getallmedicament(){
        try{
            $medicaments = Medicament::all();
            return response()->json($medicaments,200);
        }
        catch (\Exception $e){
            return response()->json(['error'=>'Failed to retrieve medicaments: '.$e->getMessage()],500);
        }
    }

}
