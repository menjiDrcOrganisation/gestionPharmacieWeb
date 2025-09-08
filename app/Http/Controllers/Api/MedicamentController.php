<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Medicament;
use App\Models\Pharmacie;
use App\Models\lot;

class MedicamentController extends Controller
{
    /**
     * Liste des médicaments d'une pharmacie
     */
    public function index($id_pharmacie)
    {
        try {
            $pharmacie = Pharmacie::findOrFail($id_pharmacie);
           

            $lots = lot::with([
                'medicament.forme', 
                'medicament.dose', 
                'pharmacie'])->where('id_pharmacie', $id_pharmacie)->get();
                
            return response()->json([
                'message' => 'Voici les médicaments de cette pharmacie',
                'data' => $lots
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Une erreur est survenue',
                'error' => $th->getMessage()
            ], 500);
        }
    }

    
    public function getallmedicament()
    {
        try {
            $medicaments = Medicament::all();
           

            $lots = lot::with([
                'medicament.forme', 
                'medicament.dose', 
                'pharmacie'])->get();
                

            return response()->json([
                'message' => 'Voici les médicaments',
                'data' => $lots
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Une erreur est survenue',
                'error' => $th->getMessage()
            ], 500);
        }
    }

    

    /**
     * Ajouter un médicament à une pharmacie
     */
    public function store(Request $request, $id_pharmacie)
    {
        try {
            $pharmacie = Pharmacie::findOrFail($id_pharmacie);

            // calcul du prix unitaire
            $indice = $pharmacie->indice;
            $prix_unitaire = $indice * $request->input("prix_achat");

            // ajout du médicament pour une pharmacie 
            $lot = lot::create([
                'numero_lot'     => 'LOT' . time(), // numéro unique
                'prix_achat'     => $request->input("prix_achat"),
                'quantite'       => $request->input("quantite"),
                'prix_unitaire'  => $prix_unitaire,
                'date_expiration'=> $request->input("date_expiration"),
                'id_pharmacie'   => $id_pharmacie,  
                'id_medicament'  => $request->input("id_medicament"),   
                'id_fournisseur' => $request->input("id_fournisseur", 1),   
            ]);

            return response()->json([
                'message' => 'Médicament ajouté avec succès',
                'data' => $lot
            ], 201);

        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Une erreur est survenue',
                'error' => $th->getMessage()
            ], 500);
        }
    }

    /**
     * Afficher un médicament d'une pharmacie
     */
    public function show($id_pharmacie, $id_medicament)
    {
        try {
            $lot = lot::with(['medicament.forme', 
                'medicament.dose', 'pharmacie'])
                        ->where('id_pharmacie', $id_pharmacie)
                        ->where('id_medicament', $id_medicament)
                        ->get();

            return response()->json([
                'message' => 'Médicament trouvé',
                'data' => $lot
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Médicament introuvable ou erreur',
                'error' => $th->getMessage()
            ], 404);
        }
    }

    /**
     * Modifier un médicament d'une pharmacie
     */
    public function update(Request $request, $id_pharmacie, $id_medicament)
    {
        try {
            $lot = lot::where('id_pharmacie', $id_pharmacie)
                      ->where('id_medicament', $id_medicament)
                      ->get();

            $lot->update([
                'prix_achat'     => $request->input("prix_achat", $lot->prix_achat),
                'quantite'       => $request->input("quantite", $lot->quantite),
                'date_expiration'=> $request->input("date_expiration", $lot->date_expiration),
            ]);

            // recalcul du prix unitaire si prix_achat est modifié
            if ($request->has("prix_achat")) {
                $indice = Pharmacie::find($id_pharmacie)->indice;
                $lot->prix_unitaire = $indice * $lot->prix_achat;
                $lot->save();
            }

            return response()->json([
                'message' => 'Médicament mis à jour avec succès',
                'data' => $lot
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Mise à jour échouée',
                'error' => $th->getMessage()
            ], 500);
        }
    }

    /**
     * Supprimer un médicament d'une pharmacie
     */
    public function destroy($id_pharmacie, $id_medicament)
    {
        try {
            $lot = lot::where('id_pharmacie', $id_pharmacie)
                      ->where('id_medicament', $id_medicament)
                      ->get();
            $lot->delete();

            return response()->json([
                'message' => 'Médicament supprimé avec succès'
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Suppression échouée',
                'error' => $th->getMessage()
            ], 500);
        }
    }
}
