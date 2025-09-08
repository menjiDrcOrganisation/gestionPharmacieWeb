@extends('layouts.main')

@section('content')
<div class="max-w-lg mx-auto mt-10 p-6 border rounded">
    <h1 class="text-2xl font-bold mb-5">Détails de la Forme</h1>

    <p><strong>ID :</strong> {{ $forme->id_forme }}</p>
    <p><strong>Nom :</strong> {{ $forme->nom }}</p>
    <p><strong>Description :</strong> {{ $forme->description ?? 'Aucune description' }}</p>

    <a href="{{ route('formes.index') }}" class="mt-5 inline-block bg-gray-500 text-white px-4 py-2 rounded">Retour</a>
</div>
@endsection
