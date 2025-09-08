<?php

namespace App\Http\Controllers;

use App\Models\Pharmacie;
use App\Http\Requests\PharmacieRequest;
use Illuminate\Http\Request;

class PharmacieController extends Controller
{
    public function index()
    {
        $pharmacies = Pharmacie::with('gerant')->get();
        return view('pharmacie.index', compact('pharmacies'));
    }

    public function create()
    {
        return view('pharmacie.create');
    }

    public function store(PharmacieRequest $request)
    {
        Pharmacie::create($request->validated());
        return redirect()->route('pharmacie.index')->with('success', 'Pharmacie créée avec succès !');
    }

    public function edit($id)
    {
        $pharmacie = Pharmacie::findOrFail($id);
        return view('pharmacie.edit', compact('pharmacie'));
    }

    public function update(PharmacieRequest $request, $id)
    {
        $pharmacie = Pharmacie::findOrFail($id);
        $pharmacie->update($request->validated());

        return redirect()->route('pharmacie.index')->with('success', 'Pharmacie mise à jour avec succès !');
    }

    public function destroy($id)
    {
        $pharmacie = Pharmacie::findOrFail($id);
        $pharmacie->delete();

        return redirect()->route('pharmacie.index')->with('success', 'Pharmacie supprimée avec succès !');
    }
}
