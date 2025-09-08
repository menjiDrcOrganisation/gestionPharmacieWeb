@extends('layouts.main')

@section('content')
<div class="max-w-5xl mx-auto mt-10">
    <h1 class="text-2xl font-bold mb-5">Liste des Formes</h1>

    @if(session('success'))
        <div class="bg-green-200 text-green-800 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <!-- 🔎 Recherche -->
    <form method="GET" action="{{ route('formes.index') }}" class="flex items-center mb-5 gap-2">
        <input type="text" name="search" value="{{ request('search') }}" 
               placeholder="Rechercher une forme..." 
               class="border rounded p-2 w-1/3">
        <button class="bg-blue-500 text-white px-4 py-2 rounded">Rechercher</button>
        <a href="{{ route('formes.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded">Réinitialiser</a>
    </form>

    <a href="{{ route('formes.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">+ Nouvelle Forme</a>

    <table class="w-full mt-5 border border-gray-300">
        <thead class="bg-gray-200">
            <tr>
                <th class="border px-4 py-2">ID</th>
                <th class="border px-4 py-2">Nom</th>
                <th class="border px-4 py-2">Description</th>
                <th class="border px-4 py-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($formes as $forme)
            <tr>
                <td class="border px-4 py-2">{{ $forme->id_forme }}</td>
                <td class="border px-4 py-2">{{ $forme->nom }}</td>
                <td class="border px-4 py-2">{{ $forme->description }}</td>
                <td class="border px-4 py-2 flex gap-2">
                    <a href="{{ route('formes.show', $forme) }}" class="bg-green-500 text-white px-2 py-1 rounded">Voir</a>
                    <a href="{{ route('formes.edit', $forme) }}" class="bg-yellow-500 text-white px-2 py-1 rounded">Modifier</a>
                    <form action="{{ route('formes.destroy', $forme) }}" method="POST" onsubmit="return confirm('Supprimer ?')">
                        @csrf
                        @method('DELETE')
                        <button class="bg-red-500 text-white px-2 py-1 rounded">Supprimer</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="text-center py-4">Aucune forme trouvée.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <!-- 📄 Pagination -->
    <div class="mt-5">
        {{ $formes->appends(request()->query())->links() }}
    </div>
</div>
@endsection
