<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Formes;
use Illuminate\Http\Request;

class FormeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $formes = Formes::all();
            return response()->json($formes, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to retrieve formes'], 500);
        }
        // // --- IGNORE ---
        // return response()->json(['message' => 'Not implemented'], 501);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            // Validate the request data if necessary

            $request->validate([
                'nom' => 'required|string|max:255',
                'description' => 'nullable|string',
            ]);
            $forme = Formes::create($request->all());
            return response()->json($forme, 201);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
        // // --- IGNORE ---
        // return response()->json(['message' => 'Not implemented'], 501);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
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
