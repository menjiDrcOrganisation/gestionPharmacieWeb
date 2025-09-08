@extends('layouts.main')

@section('content')
<div class="max-w-lg mx-auto mt-10">
    <h1 class="text-xl font-bold mb-5">Modifier le Médicament</h1>

    <form action="{{ route('medicaments.update', $medicament) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')
        <div>
            <label class="block">Nom</label>
            <input type="text" name="nom" value="{{ $medicament->nom }}" class="w-full border rounded p-2" required>
        </div>
        <div>
            <label class="block">Description</label>
            <textarea name="description" class="w-full border rounded p-2">{{ $medicament->description }}</textarea>
        </div>
        <div>
            <label class="block">Forme</label>
            <select name="id_forme" class="w-full border rounded p-2" required>
                @foreach($formes as $forme)
                    <option value="{{ $forme->id_forme }}" {{ $medicament->id_forme == $forme->id_forme ? 'selected' : '' }}>
                        {{ $forme->nom }}
                    </option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="block">Dose</label>
            <select name="id_dose" class="w-full border rounded p-2" required>
                @foreach($doses as $dose)
                    <option value="{{ $dose->id_dose }}" {{ $medicament->id_dose == $dose->id_dose ? 'selected' : '' }}>
                        {{ $dose->quantite }} {{ $dose->unite }}
                    </option>
                @endforeach
            </select>
        </div>
        <button class="bg-yellow-500 text-white px-4 py-2 rounded">Mettre à jour</button>
    </form>
</div>
@endsection
