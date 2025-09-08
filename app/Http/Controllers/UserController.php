<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //
     public function index()
    {
        //
        
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
    public function store(CreateMedicamentRequest $request)
    {
        return $request->all();
    }


      /**
     * get medicament.
     */
    public function get()
    {
        
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Medicament $medicament)
    {
        //
    }
}
