<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Dose;
use Illuminate\Http\Request;

class DoseController extends Controller
{
    //

     /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $doses = Dose::all();
            return response()->json($doses, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to retrieve doses'], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            // Validate the request data if necessary
            $request->validate([
                'quantite' => 'required|numeric',
                'unite' => 'required|string|max:255',
            ]);
            $dose = Dose::create($request->all());
            return response()->json($dose, 201);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Dose $dose)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Dose $dose)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
