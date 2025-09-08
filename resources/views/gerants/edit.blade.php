@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto mt-10 bg-white p-6 rounded shadow">
    <h1 class="text-2xl font-bold mb-5">Modifier le Gérant</h1>

    <form action="{{ route('gerants.update', $gerant) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label class="block font-medium">Nom</label>
            <input type="text" name="name" value="{{ old('name', $gerant->user->name) }}" class="w-full border rounded p-2">
            @error('name') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block font-medium">Email</label>
            <input type="email" name="email" value="{{ old('email', $gerant->user->email) }}" class="w-full border rounded p-2">
            @error('email') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block font-medium">Téléphone</label>
            <input type="text" name="phone" value="{{ old('phone', $gerant->user->phone) }}" class="w-full border rounded p-2">
            @error('phone') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <div class="border-t pt-4">
            <p class="text-gray-600 text-sm mb-2">
                ⚠️ Laissez vide si vous ne voulez pas changer le mot de passe.
            </p>

            <label class="block font-medium">Nouveau mot de passe</label>
            <input type="password" name="password" class="w-full border rounded p-2">
            @error('password') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block font-medium">Confirmer le nouveau mot de passe</label>
            <input type="password" name="password_confirmation" class="w-full border rounded p-2">
        </div>

        <button class="bg-yellow-500 text-white px-4 py-2 rounded">Mettre à jour</button>
        <a href="{{ route('gerants.index') }}" class="ml-2 bg-gray-500 text-white px-4 py-2 rounded">Annuler</a>
    </form>
</div>
@endsection
