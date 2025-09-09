@extends('layouts.main')

@section('content')
<div class="max-w-3xl mx-auto bg-white shadow-lg rounded-lg p-6">
    <h1 class="text-2xl font-bold mb-6">➕ Ajouter une pharmacie</h1>

    <form action="{{ route('pharmacies.store') }}" method="POST" class="space-y-5">
        @csrf

        <div>
            <label class="block text-gray-700 font-semibold mb-1">Nom</label>
            <input type="text" name="nom" value="{{ old('nom') }}" required
                   class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring focus:ring-blue-300">
        </div>

        <div>
            <label class="block text-gray-700 font-semibold mb-1">Adresse</label>
            <input type="text" name="adresse" value="{{ old('adresse') }}" required
                   class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring focus:ring-blue-300">
        </div>

        <div>
            <label class="block text-gray-700 font-semibold mb-1">Téléphone</label>
            <input type="text" name="telephone" value="{{ old('telephone') }}" required
                   class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring focus:ring-blue-300">
        </div>

        <div>
            <label class="block text-gray-700 font-semibold mb-1">Indice</label>
            <input type="number" step="0.1" name="indice" value="{{ old('indice') }}"
                   class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring focus:ring-blue-300">
        </div>

        <div>
            <label class="block text-gray-700 font-semibold mb-1">Gérant</label>
            <select name="id_gerant" required
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring focus:ring-blue-300">
                <option value="">-- Choisir --</option>
                @foreach($gerants as $gerant)
                    <option value="{{ $gerant->id }}">{{ $gerant->user->name }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block text-gray-700 font-semibold mb-1">Statut</label>
            <select name="statut" required
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring focus:ring-blue-300">
                <option value="en_attente">En attente</option>
                <option value="valide">Validée</option>
                <option value="ferme">Fermée</option>
            </select>
        </div>

        <div class="flex justify-end gap-3">
            <a href="{{ route('pharmacies.index') }}" 
               class="px-4 py-2 bg-gray-500 hover:bg-gray-600 text-dark rounded-lg shadow">Annuler</a>
            <button type="submit" 
                    class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-dark rounded-lg shadow">Enregistrer</button>
        </div>
    </form>
</div>
@endsection
