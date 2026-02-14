<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pharmacie; // Assure-toi d’avoir le modèle Pharmacie

class PharmacieController extends Controller
{
    // Liste toutes les pharmacies
    public function index()
    {
        return response()->json([
            'data' => Pharmacie::all()
        ]);
    }

    // Crée une nouvelle pharmacie
    public function store(Request $request)
    {
        $pharmacie = Pharmacie::create($request->all());
        return response()->json($pharmacie, 201);
    }

    // Affiche une pharmacie spécifique
    public function show($id_pharmacie)
    {
        $pharmacie = Pharmacie::findOrFail($id_pharmacie);
        return response()->json($pharmacie);
    }

    // Met à jour une pharmacie
    public function update(Request $request, $id_pharmacie)
    {
        $pharmacie = Pharmacie::findOrFail($id_pharmacie);
        $pharmacie->update($request->all());
        return response()->json($pharmacie);
    }

    // Supprime une pharmacie
    public function destroy($id_pharmacie)
    {
        $pharmacie = Pharmacie::findOrFail($id_pharmacie);
        $pharmacie->delete();
        return response()->json(null, 204);
    }

    public function pharmaciesDuGerant($id_gerant)
    {
        $pharmacies = Pharmacie::where('id_gerant', $id_gerant)->get();
        return response()->json($pharmacies);
    }
}
