<?php

namespace App\Http\Controllers;

use App\Models\Dose;
use App\Models\Formes;
use App\Models\Medicament;
use Illuminate\Http\Request;

use Illuminate\Http\Request\CreateMedicamentRequest;

class MedicamentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $medicaments = Medicament::with('dose', 'forme')
            ->get();
        $formes = Formes::all();
        $doses = Dose::all();
         

        return view('medicaments.index', compact('medicaments', 'doses', 'formes'));
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

            $medocs = Medicament::create($request->all());

            return redirect()->back()->with('success', 'Medicament ajouté avec succès ');

        } catch (\Throwable $th) {

            return redirect()->back()->with('error', 'erreur lors de l enregistrement');
        }
    }


    /**
     * get medicament.
     */
    public function get()
    {
        return [
            "gffgf"
        ];
    }

    /**
     * Display the specified resource.
     */
    public function show(Medicament $medicament)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Medicament $medicament)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Medicament $medicament)
    {
           try {

           $medicament->update($request->all());
 
            return redirect()->back()->with('success', 'Pharmacie modifie avec succes');

        } catch (\Throwable $th) {
            
            return redirect()->back()->with('error', 'erreur lors de la modification');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Medicament $medicament)
    {
         try {

           $medicament->delete();
 
            return redirect()->back()->with('success', 'Pharmacie supprime avec succes');

        } catch (\Throwable $th) {
            
            return redirect()->back()->with('error', 'erreur lors de la suppression');
        }
    }

     public function change_statut(Medicament $medicament,)
    {

        try {

           $medicament->update($request->all());
 
            return redirect()->back()->with('success', 'Le status est mise a jour');

        } catch (\Throwable $th) {
            
            return redirect()->back()->with('error', 'erreur lors de la modification du status');
        }
    
    }



}
