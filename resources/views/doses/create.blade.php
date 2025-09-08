@extends('layouts.main')

@section('content')
<div class="max-w-lg mx-auto mt-10">
    <h1 class="text-xl font-bold mb-5">Ajouter une Dose</h1>

    <form action="{{ route('doses.store') }}" method="POST" class="space-y-4">
        @csrf
        <div>
            <label class="block">Quantité</label>
            <input type="number" step="0.01" name="quantite" class="w-full border rounded p-2" required>
        </div>
        <div>
            <label class="block">Unité</label>
            <input type="text" name="unite" class="w-full border rounded p-2" required>
        </div>
        <button class="bg-blue-500 text-white px-4 py-2 rounded">Enregistrer</button>
    </form>
</div>
@endsection
