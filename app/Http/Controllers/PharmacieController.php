<?php

namespace App\Http\Controllers;

use App\Models\gerant;
use App\Models\Pharmacie;
use Illuminate\Http\Request;

class PharmacieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pharmacies = Pharmacie::with('gerant')
            ->with('gerant.user')
            ->get();

        $gerants = gerant::with('user')->
            get();

        return view('pharmacies.index', compact('pharmacies', 'gerants'));
    }

    /**
     * Show the form for creating a new resource.
     */


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {

            $pharmacie = Pharmacie::create($request->all());

            return redirect()->back()->with('success', 'Pharmacie ajoutée avec succès ');

        } catch (\Throwable $th) {

        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Pharmacie $pharmacie)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pharmacie $pharmacie)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pharmacie $pharmacie)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pharmacie $pharmacie)
    {
        //
    }
}
