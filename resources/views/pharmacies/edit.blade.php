@extends('layouts.main')

@section('content')
<div class="max-w-3xl mx-auto bg-white shadow-lg rounded-lg p-6">
    <h1 class="text-2xl font-bold mb-6">✏️ Modifier la pharmacie</h1>

    <form action="{{ route('pharmacies.update', $pharmacy) }}" method="POST" class="space-y-5">
        @csrf
        @method('PUT')

        <div>
            <label class="block text-gray-700 font-semibold mb-1">Nom</label>
            <input type="text" name="nom" value="{{ old('nom', $pharmacy->nom) }}" required
                   class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring focus:ring-blue-300">
        </div>

        <div>
            <label class="block text-gray-700 font-semibold mb-1">Adresse</label>
            <input type="text" name="adresse" value="{{ old('adresse', $pharmacy->adresse) }}" required
                   class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring focus:ring-blue-300">
        </div>

        <div>
            <label class="block text-gray-700 font-semibold mb-1">Téléphone</label>
            <input type="text" name="telephone" value="{{ old('telephone', $pharmacy->telephone) }}" required
                   class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring focus:ring-blue-300">
        </div>

        <div>
            <label class="block text-gray-700 font-semibold mb-1">Indice</label>
            <input type="number" step="0.1" name="indice" value="{{ old('indice', $pharmacy->indice) }}"
                   class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring focus:ring-blue-300">
        </div>

        <div>
            <label class="block text-gray-700 font-semibold mb-1">Gérant</label>
            <select name="id_gerant" required
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring focus:ring-blue-300">
                <option value="">-- Choisir --</option>
                @foreach($gerants as $gerant)
                    <option value="{{ $gerant->id }}" {{ $pharmacy->id_gerant == $gerant->id ? 'selected' : '' }}>
                        {{ $gerant->user->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block text-gray-700 font-semibold mb-1">Statut</label>
            <select name="statut" required
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring focus:ring-blue-300">
                <option value="en_attente" {{ $pharmacy->statut == 'en_attente' ? 'selected' : '' }}>En attente</option>
                <option value="valide" {{ $pharmacy->statut == 'valide' ? 'selected' : '' }}>Validée</option>
                <option value="ferme" {{ $pharmacy->statut == 'ferme' ? 'selected' : '' }}>Fermée</option>
            </select>
        </div>

        <div class="flex justify-end gap-3">
            <a href="{{ route('pharmacies.index') }}" 
               class="px-4 py-2 bg-gray-500 hover:bg-gray-600 text-white rounded-lg shadow">Annuler</a>
            <button type="submit" 
                    class="px-4 py-2 bg-yellow-500 hover:bg-yellow-600 text-white rounded-lg shadow">Mettre à jour</button>
        </div>
    </form>
</div>
@endsection
