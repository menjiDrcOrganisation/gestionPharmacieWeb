<?php 

namespace App\Http\Controllers\Api;

use App\Http\Requests\StoreVenteRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vente;
use App\Models\Lot;
use App\Models\Pharmacie;

class VenteController extends Controller
{
    /**
     * Liste des ventes d'une pharmacie
     */
    public function index($id_pharmacie)
    {
        try {
            $ventes = Vente::with('lots.medicament.forme,lots.medicament.dose')
                ->where('id_pharmacie', $id_pharmacie)
                ->get();

            return response()->json([
                'message' => 'Liste des ventes',
                'data'    => $ventes
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Erreur lors de la récupération des ventes',
                'error'   => $th->getMessage()
            ], 500);
        }
    }

    /**
     * Créer une nouvelle vente
     */
    public function store(Request $request, $id_pharmacie)
    {
        try {
            $data = $request->all();
            $data['id_pharmacie'] = $id_pharmacie;

            // Créer la vente sans les lots
            $venteData = collect($data)->except(['lots_ids', 'quantite_medicament_lot'])->toArray();
            $vente = Vente::create($venteData);

            // Attacher les lots avec quantités vendues
            foreach ($data['lots_ids'] as $index => $lot_id) {
                $quantiteVendue = $data['quantite_medicament_lot'][$index];

                $lot = Lot::findOrFail($lot_id);

                if ($lot->quantite < $quantiteVendue) {
                    return response()->json([
                        'message' => "Quantité insuffisante pour le lot {$lot->numero_lot}"
                    ], 400);
                }

                // Attacher lot avec quantité (pivot table)
                $vente->lots()->attach($lot_id, ['quantite_vendue' => $quantiteVendue]);

                // Décrémenter le stock
                $lot->decrement('quantite', $quantiteVendue);
            }

            return response()->json([
                'message' => 'Vente enregistrée avec succès',
                'vente'   => $vente->load('lots')
            ], 201);

        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Erreur lors de l\'enregistrement de la vente',
                'error'   => $th->getMessage()
            ], 500);
        }
    }

    /**
     * Afficher une vente
     */
    public function show($id_pharmacie, $id_vente)
    {
        try {
            $vente = Vente::with('lots')
                ->where('id_pharmacie', $id_pharmacie)
                ->where('id', $id_vente)
                ->firstOrFail();

            return response()->json([
                'message' => 'Détails de la vente',
                'data'    => $vente
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Vente introuvable',
                'error'   => $th->getMessage()
            ], 404);
        }
    }

    /**
     * Mettre à jour une vente
     */
    public function update(Request $request, $id_pharmacie, $id_vente)
    {
        try {
            $vente = Vente::where('id_pharmacie', $id_pharmacie)
                          ->where('id', $id_vente)
                          ->firstOrFail();

            $vente->update($request->all());

            return response()->json([
                'message' => 'Vente mise à jour avec succès',
                'data'    => $vente
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Erreur lors de la mise à jour',
                'error'   => $th->getMessage()
            ], 500);
        }
    }

    /**
     * Supprimer une vente
     */
    public function destroy($id_pharmacie, $id_vente)
    {
        try {
            $vente = Vente::where('id_pharmacie', $id_pharmacie)
                          ->where('id', $id_vente)
                          ->firstOrFail();

            $vente->delete();

            return response()->json([
                'message' => 'Vente supprimée avec succès'
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Erreur lors de la suppression',
                'error'   => $th->getMessage()
            ], 500);
        }
    }
}
