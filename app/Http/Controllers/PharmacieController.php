<?php

namespace App\Http\Controllers;

use App\Models\Pharmacie;
use App\Models\gerant;
use Illuminate\Http\Request;

class PharmacieController extends Controller
{
    public function index()
    {
        $pharmacies = Pharmacie::with('gerant.user')->latest()->paginate(10);
        return view('pharmacies.index', compact('pharmacies'));
    }

    public function create()
    {
        $gerants = gerant::with('user')->get();
        return view('pharmacies.create', compact('gerants'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'adresse' => 'required|string|max:255',
            'telephone' => 'required|string|max:20',
            'indice' => 'nullable|numeric',
            'id_gerant' => 'required|exists:gerants,id',
            'statut' => 'required|in:en_attente,valide,ferme',
        ]);

        Pharmacie::create($validated);

        return redirect()->route('pharmacies.index')->with('success', 'Pharmacie créée avec succès.');
    }

    public function edit(Pharmacie $pharmacy)
    {
        $gerants = gerant::with('user')->get();
        return view('pharmacies.edit', compact('pharmacy', 'gerants'));
    }

    public function update(Request $request, Pharmacie $pharmacy)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'adresse' => 'required|string|max:255',
            'telephone' => 'required|string|max:20',
            'indice' => 'nullable|numeric',
            'id_gerant' => 'required|exists:gerants,id',
            'statut' => 'required|in:en_attente,valide,ferme',
        ]);

        $pharmacy->update($validated);

        return redirect()->route('pharmacies.index')->with('success', 'Pharmacie mise à jour avec succès.');
    }

    public function destroy(Pharmacie $pharmacy)
    {
        $pharmacy->delete();
        return redirect()->route('pharmacies.index')->with('success', 'Pharmacie supprimée avec succès.');
    }
    public function updateStatut(Request $request, $id)
{
    $pharmacy = Pharmacy::findOrFail($id);
    $pharmacy->update(['statut' => $request->statut]);

    return redirect()->route('pharmacies.index')->with('success', 'Statut mis à jour avec succès');
}

}
