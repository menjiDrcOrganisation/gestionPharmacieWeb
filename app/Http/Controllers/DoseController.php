<?php

namespace App\Http\Controllers;

use App\Models\Dose;
use Illuminate\Http\Request;

class DoseController extends Controller
{
    public function index()
    {
        $doses = Dose::all();
        return view('doses.index', compact('doses'));
    }

    public function create()
    {
        return view('doses.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'quantite' => 'required|numeric',
            'unite' => 'required|string|max:50',
        ]);

        Dose::create($request->all());

        return redirect()->route('doses.index')->with('success', 'Dose ajoutée avec succès !');
    }

    public function show(Dose $dose)
    {
        return view('doses.show', compact('dose'));
    }

    public function edit(Dose $dose)
    {
        return view('doses.edit', compact('dose'));
    }

    public function update(Request $request, Dose $dose)
    {
        $request->validate([
            'quantite' => 'required|numeric',
            'unite' => 'required|string|max:50',
        ]);

        $dose->update($request->all());

        return redirect()->route('doses.index')->with('success', 'Dose mise à jour avec succès !');
    }

    public function destroy(Dose $dose)
    {
        $dose->delete();

        return redirect()->route('doses.index')->with('success', 'Dose supprimée avec succès !');
    }
}
