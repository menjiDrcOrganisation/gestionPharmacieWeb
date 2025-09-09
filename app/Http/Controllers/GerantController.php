<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Gerant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class GerantController extends Controller
{
    public function index()
    {
        $gerants = gerant::with('user')->paginate(10);
        return view('gerants.index', compact('gerants'));
    }

    public function create()
    {
        return view('gerants.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users',
            'phone'    => 'required|string',
            'password' => 'required|string|min:6|confirmed',
        ]);

        // Création d'un user de rôle gerant
        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'phone'    => $request->phone,
            'password' => Hash::make($request->password),
            'role'     => 'gerant',
        ]);

        // Associer à la table gerants
        gerant::create(['user_id' => $user->id]);

        return redirect()->route('gerants.index')->with('success', 'Gérant créé avec succès.');
    }

    public function show(gerant $gerant)
    {
        return view('gerants.show', compact('gerant'));
    }

    public function edit(gerant $gerant)
    {
        return view('gerants.edit', compact('gerant'));
    }

    public function update(Request $request, gerant $gerant)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$gerant->user_id,
            'phone' => 'required|string',
        ]);

        $gerant->user->update([
            'name'  => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
        ]);

        if ($request->filled('password')) {
            $gerant->user->update([
                'password' => Hash::make($request->password),
            ]);
        }

        return redirect()->route('gerants.index')->with('success', 'Gérant mis à jour avec succès.');
    }

    public function destroy(gerant $gerant)
    {
        $gerant->user->delete(); // supprime aussi l'entrée dans `gerants` via cascade
        $gerant->delete(); 
        return redirect()->route('gerants.index')->with('success', 'Gérant supprimé.');
    }
}
