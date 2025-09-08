<?php

namespace App\Http\Controllers;

use App\Models\Medicament;
use App\Models\Formes;
use App\Models\Dose;
use Illuminate\Http\Request;

class MedicamentController extends Controller
{
    public function index(Request $request)
    {
        $query = Medicament::with(['forme', 'dose']);

        if ($request->has('search') && !empty($request->search)) {
            $query->where('nom', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%');
        }

        $medicaments = $query->orderBy('id', 'desc')->paginate(10);

        return view('medicaments.index', compact('medicaments'));
    }

    public function create()
    {
        $formes = Formes::all();
        $doses = Dose::all();
        return view('medicaments.create', compact('formes', 'doses'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'nullable|string',
            'id_forme' => 'required|exists:formes,id_forme',
            'id_dose' => 'required|exists:doses,id_dose',
        ]);

        Medicament::create($request->all());

        return redirect()->route('medicaments.index')->with('success', 'Médicament ajouté avec succès !');
    }

    public function show(Medicament $medicament)
    {
        $medicament->load(['forme', 'dose']);
        return view('medicaments.show', compact('medicament'));
    }

    public function edit(Medicament $medicament)
    {
        $formes = Formes::all();
        $doses = Dose::all();
        return view('medicaments.edit', compact('medicament', 'formes', 'doses'));
    }

    public function update(Request $request, Medicament $medicament)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'nullable|string',
            'id_forme' => 'required|exists:formes,id_forme',
            'id_dose' => 'required|exists:doses,id_dose',
        ]);

        $medicament->update($request->all());

        return redirect()->route('medicaments.index')->with('success', 'Médicament mis à jour avec succès !');
    }

    public function destroy(Medicament $medicament)
    {
        $medicament->delete();
        return redirect()->route('medicaments.index')->with('success', 'Médicament supprimé avec succès !');
    }
}
