@extends('layouts.main')

@section('content')
<div class="max-w-6xl mx-auto mt-10">
    <h1 class="text-2xl font-bold mb-5">Liste des Médicaments</h1>

    @if(session('success'))
        <div class="bg-green-200 text-green-800 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <!-- 🔎 Recherche -->
    <form method="GET" action="{{ route('medicaments.index') }}" class="flex items-center mb-5 gap-2">
        <input type="text" name="search" value="{{ request('search') }}" 
               placeholder="Rechercher un médicament..." 
               class="border rounded p-2 w-1/3">
        <button class="bg-blue-500 text-white px-4 py-2 rounded">Rechercher</button>
        <a href="{{ route('medicaments.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded">Réinitialiser</a>
    </form>

    <a href="{{ route('medicaments.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">+ Nouveau Médicament</a>

    <table class="w-full mt-5 border border-gray-300">
        <thead class="bg-gray-200">
            <tr>
                <th class="border px-4 py-2">ID</th>
                <th class="border px-4 py-2">Nom</th>
                <th class="border px-4 py-2">Forme</th>
                <th class="border px-4 py-2">Dose</th>
                <th class="border px-4 py-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($medicaments as $medicament)
            <tr>
                <td class="border px-4 py-2">{{ $medicament->id }}</td>
                <td class="border px-4 py-2">{{ $medicament->nom }}</td>
                <td class="border px-4 py-2">{{ $medicament->forme->nom }}</td>
                <td class="border px-4 py-2">{{ $medicament->dose->quantite }} {{ $medicament->dose->unite }}</td>
                <td class="border px-4 py-2 flex gap-2">
                    <a href="{{ route('medicaments.show', $medicament) }}" class="bg-green-500 text-white px-2 py-1 rounded">Voir</a>
                    <a href="{{ route('medicaments.edit', $medicament) }}" class="bg-yellow-500 text-white px-2 py-1 rounded">Modifier</a>
                    <form action="{{ route('medicaments.destroy', $medicament) }}" method="POST" onsubmit="return confirm('Supprimer ?')">
                        @csrf
                        @method('DELETE')
                        <button class="bg-red-500 text-white px-2 py-1 rounded">Supprimer</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center py-4">Aucun médicament trouvé.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-5">
        {{ $medicaments->appends(request()->query())->links() }}
    </div>
</div>
@endsection
