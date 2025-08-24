<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\StoreVenteRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Vente;
use App\Models\Lot;

class VenteController extends Controller
{
    public function index()
    {
      
        $ventes = Vente::with("lots")->get();

        return response()->json($ventes);
    }


     public function store(Request $request, $id_pharmacie)
     {
       
        $data=$request->all();
        $data['id_pharmacie'] = $id_pharmacie;

        // Créer la vente sans les lots
        $venteData = collect($data)->except(['lots_ids', 'quantite_medicament_lot'])->toArray();
        $vente = Vente::create($venteData);
    
        // Attacher les lots et décrémenter les quantités
        foreach ($data['lots_ids'] as $index => $lot_id) {
            $quantiteVendue = $data['quantite_medicament_lot'][$index];
    
            // Attacher le lot à la vente
            $vente->lots()->attach($lot_id);

            // Décrémenter la quantité dans le lot
            $lot = Lot::find($lot_id);
            if ($lot) {
                $lot->quantite -= $quantiteVendue;
                $lot->save();
            }
        }

         return response()->json([
             'message' => 'Vente enregistrée avec succès',
             'vente'   => $vente
         ], 201);
     }
     
     
 
     // Affiche une vente spécifique d'un lot
     public function show($id_lot, Vente $vente)
     {
         return response()->json($vente);
     }
 
     // Met à jour une vente

     public function update(Request $request, $id_lot, Vente $vente)
     {
         $vente->update($request->all());
         return response()->json($vente);
     }
 
     // Supprime une vente
     public function destroy($id_lot, Vente $vente)
     {
         $vente->delete();
         return response()->json(['message' => 'Vente supprimée']);
     }
}
