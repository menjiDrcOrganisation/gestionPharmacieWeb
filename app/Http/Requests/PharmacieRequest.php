<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PharmacieRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            //
            'nom' =>['required', 'string', 'max:255' ],
            'adresse' => ['required', 'string', 'max:255'],
            'telephone' => ['required','integer'],
            'indice' => ['nullable','numeric'],
            'id_gerant' => ['required','integer','exists:gerants,id_gerant'],
            'statut' => ['required','in:en_attente,valide,ferme'],
            
        ];
    }
}
