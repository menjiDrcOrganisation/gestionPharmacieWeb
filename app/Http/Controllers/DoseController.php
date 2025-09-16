<?php

namespace App\Http\Controllers;

use App\Models\Dose;
use Illuminate\Http\Request;

class DoseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $doses = Dose::all();

        return view('doses.index', compact('doses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {

            $dose = Dose::create($request->all());

            return redirect()->back()->with('success', 'Dose ajoutée avec succès ');

        } catch (\Throwable $th) {
            dd($th->getMessage());
            return redirect()->back()->with('error', 'erreur lors de l enregistrement');
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

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Dose $dose)
    {
        try {

         $dose->update($request->all());
 
            return redirect()->back()->with('success', 'dose modifie avec succes');

        } catch (\Throwable $th) {
            
            return redirect()->back()->with('error', 'erreur lors de la modification');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Dose $dose)
    {
         try {

         $dose->delete();
 
            return redirect()->back()->with('success', 'dose supprime avec succes');

        } catch (\Throwable $th) {
            
            return redirect()->back()->with('error', 'erreur lors de la suppression');
        }
    }
}
