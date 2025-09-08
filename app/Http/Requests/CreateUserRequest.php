<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
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
    $gerantId = $this->route('gerant') ? $this->route('gerant')->id : null;
    
    return [
        'name' => 'required|string|min:3|max:100',
        'email' => 'required|email|unique:users,email,' . $gerantId,
        'phone' => 'required|string|min:8|max:20',
        'password' => 'nullable|string|min:6|confirmed',
        'role' => 'required|in:admin,gerant,vendeur,client',
    ];
}

    public function messages(): array
    {
        return [
            'name.required' => 'Le nom est obligatoire.',
            'email.required' => 'L’email est obligatoire.',
            'email.email' => 'Veuillez entrer un email valide.',
            'email.unique' => 'Cet email existe déjà.',
            'phone.required' => 'Le numéro de téléphone est obligatoire.',
            'password.required' => 'Le mot de passe est obligatoire.',
            'password.confirmed' => 'Les mots de passe ne correspondent pas.',
            'role.in' => 'Le rôle choisi est invalide.',
        ];
    }
}
