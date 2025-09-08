<?php

namespace App\Http\Controllers;

use App\Models\Formes;
use Illuminate\Http\Request;

class FormesController extends Controller
{
    public function index(Request $request)
    {
        $query = Formes::query();

        // 🔎 Recherche
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where('nom', 'like', "%$search%")
                  ->orWhere('description', 'like', "%$search%");
        }

        $formes = $query->orderBy('id_forme', 'desc')->paginate(10);

        return view('formes.index', compact('formes'));
    }

    public function create()
    {
        return view('formes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:100',
            'description' => 'nullable|string',
        ]);

        Formes::create($request->all());

        return redirect()->route('formes.index')->with('success', 'Forme ajoutée avec succès !');
    }

    public function show(Formes $forme)
    {
        return view('formes.show', compact('forme'));
    }

    public function edit(Formes $forme)
    {
        return view('formes.edit', compact('forme'));
    }

    public function update(Request $request, Formes $forme)
    {
        $request->validate([
            'nom' => 'required|string|max:100',
            'description' => 'nullable|string',
        ]);

        $forme->update($request->all());

        return redirect()->route('formes.index')->with('success', 'Forme mise à jour avec succès !');
    }

    public function destroy(Formes $forme)
    {
        $forme->delete();

        return redirect()->route('formes.index')->with('success', 'Forme supprimée avec succès !');
    }
}
