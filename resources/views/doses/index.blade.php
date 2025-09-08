@extends('layouts.main')

@section('content')
<div class="max-w-4xl mx-auto mt-10">
    <h1 class="text-2xl font-bold mb-5">Liste des Doses</h1>

    @if(session('success'))
        <div class="bg-green-200 text-green-800 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('doses.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">+ Nouvelle Dose</a>

    <table class="w-full mt-5 border border-gray-300">
        <thead class="bg-gray-200">
            <tr>
                <th class="border px-4 py-2">ID</th>
                <th class="border px-4 py-2">Quantité</th>
                <th class="border px-4 py-2">Unité</th>
                <th class="border px-4 py-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($doses as $dose)
            <tr>
                <td class="border px-4 py-2">{{ $dose->id_dose }}</td>
                <td class="border px-4 py-2">{{ $dose->quantite }}</td>
                <td class="border px-4 py-2">{{ $dose->unite }}</td>
                <td class="border px-4 py-2 flex gap-2">
                    <a href="{{ route('doses.show', $dose) }}" class="bg-green-500 text-white px-2 py-1 rounded">Voir</a>
                    <a href="{{ route('doses.edit', $dose) }}" class="bg-yellow-500 text-white px-2 py-1 rounded">Modifier</a>
                    <form action="{{ route('doses.destroy', $dose) }}" method="POST" onsubmit="return confirm('Supprimer ?')">
                        @csrf
                        @method('DELETE')
                        <button class="bg-red-500 text-white px-2 py-1 rounded">Supprimer</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
