<?php

namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

class StoreVenteRequest extends FormRequest
{
    public function authorize()
    {
        return true; 
    }

    public function rules(): array
{
    return [
        'date_vente' => 'required|date',
        'montant_total' => 'required|numeric|min:0',
        'nom_client' => 'required|string|max:255',
        'id_pharmacie' => 'required|exists:pharmacies,id_pharmacie',
    ];
}
}
