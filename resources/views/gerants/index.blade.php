@extends('layouts.main')

@section('content')
<div class="max-w-6xl mx-auto mt-10">
    <h1 class="text-2xl font-bold mb-5">Liste des Gérants</h1>

    @if(session('success'))
        <div class="bg-green-200 text-green-800 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('gerants.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">+ Nouveau Gérant</a>

    <table class="w-full mt-5 border border-gray-300">
        <thead class="bg-gray-200">
            <tr>
                <th class="border px-4 py-2">ID</th>
                <th class="border px-4 py-2">Nom</th>
                <th class="border px-4 py-2">Email</th>
                <th class="border px-4 py-2">Téléphone</th>
                <th class="border px-4 py-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($gerants as $gerant)
            <tr>
                <td class="border px-4 py-2">{{ $gerant->id }}</td>
                <td class="border px-4 py-2">{{ $gerant->user->name }}</td>
                <td class="border px-4 py-2">{{ $gerant->user->email }}</td>
                <td class="border px-4 py-2">{{ $gerant->user->phone }}</td>
                <td class="border px-4 py-2 flex gap-2">
                    <a href="{{ route('gerants.show', $gerant) }}" class="bg-green-500 text-white px-2 py-1 rounded">Voir</a>
                    <a href="{{ route('gerants.edit', $gerant) }}" class="bg-yellow-500 text-white px-2 py-1 rounded">Modifier</a>
                    <form action="{{ route('gerants.destroy', $gerant) }}" method="POST" onsubmit="return confirm('Supprimer ?')">
                        @csrf @method('DELETE')
                        <button class="bg-red-500 text-white px-2 py-1 rounded">Supprimer</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-5">
        {{ $gerants->links() }}
    </div>
</div>
@endsection
