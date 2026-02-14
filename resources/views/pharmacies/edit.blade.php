<!-- Modal Edit Pharmacie -->
<dialog id="edit-pharmacie-{{ $pharmacie->id_pharmacie }}"
    class="p-6 bg-white dark:bg-slate-800 rounded-2xl shadow-xl w-full max-w-md">

    <!-- Header -->
    <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100 mb-4">
        Modifier la pharmacie
    </h3>

    <!-- Formulaire Edit -->
    <form action="{{ route('pharmacies.update', $pharmacie->id_pharmacie) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <!-- Nom -->
        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-200">
                Nom
            </label>
            <input type="text" name="nom" value="{{ $pharmacie->nom }}" required
                class="mt-1 block w-full rounded-md border border-gray-300 dark:border-slate-600 py-2 px-3 focus:ring-2 focus:ring-blue-400 dark:bg-slate-700 dark:text-white">
        </div>

        <!-- Adresse -->
        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-200">
                Adresse
            </label>
            <input type="text" name="adresse" value="{{ $pharmacie->adresse }}" required
                class="mt-1 block w-full rounded-md border border-gray-300 dark:border-slate-600 py-2 px-3 focus:ring-2 focus:ring-blue-400 dark:bg-slate-700 dark:text-white">
        </div>

        <!-- Téléphone -->
        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-200">
                Téléphone
            </label>
            <input type="text" name="telephone" value="{{ $pharmacie->telephone }}" required
                class="mt-1 block w-full rounded-md border border-gray-300 dark:border-slate-600 py-2 px-3 focus:ring-2 focus:ring-blue-400 dark:bg-slate-700 dark:text-white">
        </div>
        <!-- Indice -->
        <div>
            <label class="block text-sm font-medium text-slate-200">Indice</label>
            <input type="text" name="indice" value="{{ $pharmacie->indice }}"
                class="mt-1 block w-full rounded-md border border-slate-600 py-2 px-3 focus:ring-2 focus:ring-emerald-400">
        </div>

        <!-- Gérant -->
        <div class="sm:col-span-2">
            <label class="block text-sm font-medium text-slate-200">Gérant</label>
            <select name="id_gerant"
                class="mt-1 block w-full rounded-md border border-slate-600 py-2 px-3 focus:ring-2 focus:ring-emerald-400">
                @foreach ($gerants as $gerant)
                    <option value="{{ $gerant->id_gerant }}" {{ $gerant->id_gerant == $pharmacie->id_gerant ? 'selected' : '' }}>
                        {{ $gerant->user->email }}
                    </option>
                @endforeach
            </select>
        </div>


        <!-- Boutons -->
        <div class="flex justify-end gap-3 mt-4">
            <button type="button"
                onclick="document.getElementById('edit-pharmacie-{{ $pharmacie->id_pharmacie }}').close()"
                class="px-4 py-2 text-sm bg-gray-200 dark:bg-slate-700 text-gray-800 dark:text-gray-200 rounded hover:bg-gray-300 dark:hover:bg-slate-600">
                Annuler
            </button>

            <button type="submit"
                class="px-4 py-2 text-sm font-semibold text-white bg-blue-500 rounded hover:bg-blue-400">
                Enregistrer
            </button>
        </div>
    </form>
</dialog>
