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
        'date_vente' => 'required',
        'montant_total' => 'required|numeric|min:0',
        'nom_client' => 'required|string|max:255'
    ];

         // Validation des lots
         //'lots_ids' => 'required|array|min:1',
         //'lots_ids.*' => 'integer|exists:lots,id_lot', 
         // Validation des quantités
         //'quantite_medicament_lot' => 'required|array|min:1',
         //'quantite_medicament_lot.*' => 'integer|min:1'
}
}
