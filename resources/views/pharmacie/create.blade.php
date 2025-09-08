@extends('layouts.main ')

@section('titre', 'Ajouter une pharmacie')

@section('content')
<div class=" w-full px-6 py-6 mx-auto ">
    <div class="bg-white shadow-lg rounded-2xl p-6">
        <h1 class="text-2xl font-bold mb-6 text-center">Ajouter une pharmacie</h1>

        {{-- Affichage des erreurs --}}
        @if ($errors->any())
            <div class="mb-4 p-4 bg-red-100 text-red-600 rounded-lg">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Formulaire --}}
        <form action="{{ route('pharmacie.store') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label for="nom" class="block text-sm font-medium">Nom de la pharmacie</label>
                <input type="text" name="nom" id="nom" value="{{ old('nom') }}" 
                       class="w-full border-gray-300 rounded-lg p-2 focus:ring focus:ring-blue-300">
            </div>

            <div>
                <label for="adresse" class="block text-sm font-medium">Adresse</label>
                <input type="text" name="adresse" id="adresse" value="{{ old('adresse') }}"
                       class="w-full border-gray-300 rounded-lg p-2 focus:ring focus:ring-blue-300">
            </div>

            <div>
                <label for="telephone" class="block text-sm font-medium">Téléphone</label>
                <input type="number" name="telephone" id="telephone" value="{{ old('telephone') }}"
                       class="w-full border-gray-300 rounded-lg p-2 focus:ring focus:ring-blue-300">
            </div>

            <div>
                <label for="indice" class="block text-sm font-medium">Indice (optionnel)</label>
                <input type="number" step="0.01" name="indice" id="indice" value="{{ old('indice') }}"
                       class="w-full border-gray-300 rounded-lg p-2 focus:ring focus:ring-blue-300">
            </div>

            <div>
                <label for="id_gerant" class="block text-sm font-medium">Gérant</label>
                <select name="id_gerant" id="id_gerant" class="w-full border-gray-300 rounded-lg p-2">
                    <option value="">-- Sélectionner --</option>
                    @foreach($gerants as $gerant)
                        <option value="{{ $gerant->id_gerant }}" 
                            {{ old('id_gerant') == $gerant->id_gerant ? 'selected' : '' }}>
                            {{ $gerant->nom }} {{ $gerant->prenom }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="statut" class="block text-sm font-medium">Statut</label>
                <select name="statut" id="statut" class="w-full border-gray-300 rounded-lg p-2">
                    <option value="en_attente" {{ old('statut') == 'en_attente' ? 'selected' : '' }}>En attente</option>
                    <option value="valide" {{ old('statut') == 'valide' ? 'selected' : '' }}>Validé</option>
                    <option value="ferme" {{ old('statut') == 'ferme' ? 'selected' : '' }}>Fermé</option>
                </select>
            </div>

            <div class="flex justify-end">
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg shadow hover:bg-blue-700">
                    Enregistrer
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
