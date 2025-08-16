<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateMedicamentRequest;
use Illuminate\Http\Request;
use App\Models\Medicament;
use App\Models\Pharmacie;

class MedicamentController extends Controller
{
    /**
     * Lister tous les médicaments d'une pharmacie spécifique
     */
    public function index($id_pharmacie)
    {
        $pharmacie = Pharmacie::findOrFail($id_pharmacie);
        $medicaments = $pharmacie->medicaments()->get();

        return response()->json($medicaments);
    }

    /**
     * Ajouter un nouveau médicament et l'associer à une pharmacie
     */
    public function store(CreateMedicamentRequest $request, $id_pharmacie)
    {
        $pharmacie = Pharmacie::findOrFail($id_pharmacie);

        $medicament = Medicament::create($request->validated());

        $pharmacie->medicaments()->attach($medicament->id_medicament);

        return response()->json([
            'message' => 'Médicament enregistré avec succès',
            'data' => $medicament->load('pharmacies')
        ], 201);
    }

    /**
     * Récupérer un médicament précis dans une pharmacie
     */
    public function show($id_pharmacie, $id_medicament)
    {
        $pharmacie = Pharmacie::findOrFail($id_pharmacie);

        $medicament = $pharmacie->medicaments()
                                ->where('medicaments.id_medicament', $id_medicament)
                                ->first();

        if (!$medicament) {
            return response()->json(['message' => 'Médicament introuvable dans cette pharmacie'], 404);
        }

        return response()->json($medicament);
    }

    /**
     * Modifier un médicament dans une pharmacie
     */
    public function update(Request $request, $id_pharmacie, $id_medicament)
    {
        $pharmacie = Pharmacie::findOrFail($id_pharmacie);

        $medicament = $pharmacie->medicaments()
                                ->where('medicaments.id_medicament', $id_medicament)
                                ->first();

        if (!$medicament) {
            return response()->json(['message' => 'Médicament introuvable dans cette pharmacie'], 404);
        }

        $medicament->update($request->all());

        return response()->json([
            'message' => 'Médicament mis à jour avec succès',
            'data' => $medicament
        ]);
    }

    /**
     * Supprimer un médicament d'une pharmacie
     */
    public function destroy($id_pharmacie, $id_medicament)
    {
        $pharmacie = Pharmacie::findOrFail($id_pharmacie);

        $medicament = $pharmacie->medicaments()
                                ->where('medicaments.id_medicament', $id_medicament)
                                ->first();

        if (!$medicament) {
            return response()->json(['message' => 'Médicament introuvable dans cette pharmacie'], 404);
        }

        $pharmacie->medicaments()->detach($id_medicament);
        //supprimer le médicament complètement si nécessaire
        // $medicament->delete();

        return response()->json(['message' => 'Médicament supprimé avec succès']);
    }
}
