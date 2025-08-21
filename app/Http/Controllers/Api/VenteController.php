<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\StoreVenteRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Vente;
use App\Models\Lot;


class VenteController extends Controller
{
     // Liste toutes les ventes d'un lot
     public function index($id_lot)
     {
         $lot = Lot::findOrFail($id_lot);
         $ventes = $lot->ventes; 
         return response()->json($ventes);
     }
 
     // Crée une nouvelle vente pour des lots
     public function store(StoreVenteRequest $request, $id_pharmacie)
     {
        
    
         $data = $request->validated();
         return $data;
        //  $data['id_pharmacie'] = $id_pharmacie; 
        //  $vente = Vente::create($data);
     
        //  if ($request->has('lots_ids')) {
        //      $vente->lots()->attach($request->lots_ids);
        //  }
     
        //  return response()->json([
        //      'message' => 'Vente enregistrée avec succès'
        //  ], 201);
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
