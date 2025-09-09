@extends('layouts.main')

@section('content')
<div class="max-w-7xl mx-auto p-6">
    <h1 class="text-2xl font-bold mb-6">Liste des pharmacies</h1>

    <a href="{{ route('pharmacies.create') }}" 
       class="mb-4 inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2 rounded-lg shadow">
        ➕ Ajouter une pharmacie
    </a>

    <div class="overflow-x-auto bg-white shadow-md rounded-lg">
        <table class="min-w-full border border-gray-200 rounded-lg">
            <thead class="bg-gray-100">
                <tr class="text-left text-gray-700 uppercase text-sm">
                    <th class="px-6 py-3">Nom</th>
                    <th class="px-6 py-3">Adresse</th>
                    <th class="px-6 py-3">Téléphone</th>
                    <th class="px-6 py-3">Indice</th>
                    <th class="px-6 py-3">Gérant</th>
                    <th class="px-6 py-3">Statut</th>
                    <th class="px-6 py-3">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach ($pharmacies as $pharmacy)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 font-medium">{{ $pharmacy->nom }}</td>
                        <td class="px-6 py-4">{{ $pharmacy->adresse }}</td>
                        <td class="px-6 py-4">{{ $pharmacy->telephone }}</td>
                        <td class="px-6 py-4">{{ $pharmacy->indice }}</td>
                        <td class="px-6 py-4">{{ $pharmacy->gerant->user->name ?? 'N/A' }}</td>
                        <td class="px-6 py-4">
                            @if($pharmacy->statut == 'en_attente')
                                <span class="px-3 py-1 rounded-full text-xs font-semibold bg-yellow-100 text-yellow-700">En attente</span>
                            @elseif($pharmacy->statut == 'valide')
                                <span class="px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-700">Validée</span>
                            @elseif($pharmacy->statut == 'ferme')
                                <span class="px-3 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-700">Fermée</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 flex gap-2 flex-wrap">
                            <a href="{{ route('pharmacies.edit', $pharmacy) }}" 
                               class="px-3 py-1 bg-yellow-500 hover:bg-yellow-600 text-white text-sm rounded-lg shadow">
                                ✏️ Modifier
                            </a>

                            <form action="{{ route('pharmacies.destroy', $pharmacy) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr ?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="px-3 py-1 bg-red-600 hover:bg-red-700 text-white text-sm rounded-lg shadow">
                                    🗑 Supprimer
                                </button>
                            </form>

                            <!-- Actions rapides statut -->
                            <form action="{{ route('pharmacies.updateStatut', $pharmacy->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="statut" value="valide">
                                <button type="submit" 
                                        class="px-3 py-1 bg-green-600 hover:bg-green-700 text-white text-sm rounded-lg shadow">
                                    ✅ Valider
                                </button>
                            </form>

                            <form action="{{ route('pharmacies.updateStatut', $pharmacy->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="statut" value="ferme">
                                <button type="submit" 
                                        class="px-3 py-1 bg-gray-600 hover:bg-gray-700 text-white text-sm rounded-lg shadow">
                                    🚪 Fermer
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
