@extends('layouts.main')

@section('content')
<div class="max-w-lg mx-auto mt-10">
    <h1 class="text-xl font-bold mb-5">Modifier la Forme</h1>

    <form action="{{ route('formes.update', $forme) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')
        <div>
            <label class="block">Nom</label>
            <input type="text" name="nom" value="{{ $forme->nom }}" class="w-full border rounded p-2" required>
        </div>
        <div>
            <label class="block">Description</label>
            <textarea name="description" class="w-full border rounded p-2">{{ $forme->description }}</textarea>
        </div>
        <button class="bg-yellow-500 text-white px-4 py-2 rounded">Mettre à jour</button>
    </form>
</div>
@endsection
