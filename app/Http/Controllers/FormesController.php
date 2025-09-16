<?php

namespace App\Http\Controllers;

use App\Models\Formes;
use Illuminate\Http\Request;

class FormesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $formes = Formes::all();

        return view('formes.index', compact('formes'));

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

            $fomres = Formes::create($request->all());

            return redirect()->back()->with('success', 'Forme ajoutée avec succès ');

        } catch (\Throwable $th) {
          
            return redirect()->back()->with('error', 'erreur lors de l enregistrement');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Formes $formes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Formes $formes)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Formes $formes)
    {
        try {
           $formes->update($request->all());
 
            return redirect()->back()->with('success', 'Forme modifie avec succes');

        } catch (\Throwable $th) {
            
            return redirect()->back()->with('error', 'erreur lors de la modification');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Formes $formes)
    {
         try {
           $formes->delete();
 
            return redirect()->back()->with('success', 'Forme supprime avec succes');

        } catch (\Throwable $th) {
            
            return redirect()->back()->with('error', 'erreur lors de la suppression');
        }
    }
}
