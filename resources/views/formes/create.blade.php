@extends('layouts.main')

@section('content')
<div class="max-w-lg mx-auto mt-10">
    <h1 class="text-xl font-bold mb-5">Ajouter une Forme</h1>

    <form action="{{ route('formes.store') }}" method="POST" class="space-y-4">
        @csrf
        <div>
            <label class="block">Nom</label>
            <input type="text" name="nom" class="w-full border rounded p-2" required>
        </div>
        <div>
            <label class="block">Description</label>
            <textarea name="description" class="w-full border rounded p-2"></textarea>
        </div>
        <button class="bg-blue-500 text-white px-4 py-2 rounded">Enregistrer</button>
    </form>
</div>
@endsection
