@extends('layouts.main')

@section('content')
<div class="max-w-2xl mx-auto mt-10 bg-white p-6 rounded shadow">
    <h1 class="text-2xl font-bold mb-5">Ajouter un Gérant</h1>

    <form action="{{ route('gerants.store') }}" method="POST" class="space-y-4">
        @csrf

        <div>
            <label class="block font-medium">Nom</label>
            <input type="text" name="name" value="{{ old('name') }}" class="w-full border rounded p-2">
            @error('name') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block font-medium">Email</label>
            <input type="email" name="email" value="{{ old('email') }}" class="w-full border rounded p-2">
            @error('email') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block font-medium">Téléphone</label>
            <input type="text" name="phone" value="{{ old('phone') }}" class="w-full border rounded p-2">
            @error('phone') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block font-medium">Mot de passe</label>
            <input type="password" name="password" class="w-full border rounded p-2">
            @error('password') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block font-medium">Confirmer le mot de passe</label>
            <input type="password" name="password_confirmation" class="w-full border rounded p-2">
        </div>

        <button class="bg-blue-500 text-white px-4 py-2 rounded">Enregistrer</button>
        <a href="{{ route('gerants.index') }}" class="ml-2 bg-gray-500 text-white px-4 py-2 rounded">Annuler</a>
    </form>
</div>
@endsection
