<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\vente;
use Illuminate\Http\Request;

class RapportVenteController extends Controller
{
 
    public function getRapportVente(Request $request)
    {
        try{
            $request->validate([
                'id_pharmacie' => 'required|integer|exists:pharmacies,id_pharmacie',
            ]);
$rapportvente = vente::with(['lots.medicament.forme', 'lots.medicament.dose'])
    ->whereHas('lots', function ($query) use ($request) {
        $query->where('id_pharmacie', $request->id_pharmacie);
    })
   
    ->get()
    ->groupBy(function ($vente) {
        return $vente->date_vente; // groupement par jour
    });

 // maintenant tu regroupes par ta colonne calculé

                   return response()->json($rapportvente, 200);

        }catch(\Exception $e){
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

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
