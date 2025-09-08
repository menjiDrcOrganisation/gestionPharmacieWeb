@extends('layouts.main')

@section('content')
<div class="max-w-lg mx-auto mt-10">
    <h1 class="text-xl font-bold mb-5">Ajouter un Médicament</h1>

    <form action="{{ route('medicaments.store') }}" method="POST" class="space-y-4">
        @csrf
        <div>
            <label class="block">Nom</label>
            <input type="text" name="nom" class="w-full border rounded p-2" required>
        </div>
        <div>
            <label class="block">Description</label>
            <textarea name="description" class="w-full border rounded p-2"></textarea>
        </div>
        <div>
            <label class="block">Forme</label>
            <select name="id_forme" class="w-full border rounded p-2" required>
                <option value="">-- Choisir une forme --</option>
                @foreach($formes as $forme)
                    <option value="{{ $forme->id_forme }}">{{ $forme->nom }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="block">Dose</label>
            <select name="id_dose" class="w-full border rounded p-2" required>
                <option value="">-- Choisir une dose --</option>
                @foreach($doses as $dose)
                    <option value="{{ $dose->id_dose }}">{{ $dose->quantite }} {{ $dose->unite }}</option>
                @endforeach
            </select>
        </div>
        <button class="bg-blue-500 text-white px-4 py-2 rounded">Enregistrer</button>
    </form>
</div>
@endsection
