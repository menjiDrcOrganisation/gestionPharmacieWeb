@extends('layouts.main')

@section('content')
<div class="max-w-lg mx-auto mt-10 p-6 border rounded">
    <h1 class="text-2xl font-bold mb-5">Détails du Médicament</h1>

    <p><strong>ID :</strong> {{ $medicament->id }}</p>
    <p><strong>Nom :</strong> {{ $medicament->nom }}</p>
    <p><strong>Description :</strong> {{ $medicament->description ?? 'Aucune description' }}</p>
    <p><strong>Forme :</strong> {{ $medicament->forme->nom }}</p>
    <p><strong>Dose :</strong> {{ $medicament->dose->quantite }} {{ $medicament->dose->unite }}</p>

    <a href="{{ route('medicaments.index') }}" class="mt-5 inline-block bg-gray-500 text-white px-4 py-2 rounded">Retour</a>
</div>
@endsection
