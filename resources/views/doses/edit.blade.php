@extends('layouts.main')

@section('content')
<div class="max-w-lg mx-auto mt-10">
    <h1 class="text-xl font-bold mb-5">Modifier la Dose</h1>

    <form action="{{ route('doses.update', $dose) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')
        <div>
            <label class="block">Quantité</label>
            <input type="number" step="0.01" name="quantite" value="{{ $dose->quantite }}" class="w-full border rounded p-2" required>
        </div>
        <div>
            <label class="block">Unité</label>
            <input type="text" name="unite" value="{{ $dose->unite }}" class="w-full border rounded p-2" required>
        </div>
        <button class="bg-yellow-500 text-white px-4 py-2 rounded">Mettre à jour</button>
    </form>
</div>
@endsection
