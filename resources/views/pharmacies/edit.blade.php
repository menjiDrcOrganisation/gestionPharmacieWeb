<!-- Modal Edit Pharmacie -->
<dialog id="edit-pharmacie-{{ $pharmacie->id_pharmacie }}"
    class="p-6 bg-white dark:bg-slate-800 rounded-2xl shadow-xl w-full max-w-lg">

    <!-- Header -->
    <div class="flex items-center gap-3 border-b pb-3 mb-4">
        {{-- <img src="https://cdn-icons-png.flaticon.com/512/2966/2966489.png" alt="icon" class="w-6 h-6"> --}}
        <h3 class="text-lg font-semibold text-slate-800 dark:text-slate-100">
            Modifier la pharmacie
        </h3>
    </div>

    <!-- Formulaire Edit -->
    <form action="{{ route('pharmacies.update', $pharmacie->id_pharmacie) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <!-- Nom -->
        <div>
            <label class="block text-sm font-medium text-slate-700 dark:text-slate-200 text-left">
                Nom <span class="text-rose-500">*</span>
            </label>
            
            <input type="text" name="nom" value="{{ $pharmacie->nom }}" required
                class="mt-1 block w-full rounded-lg border border-slate-300 dark:border-slate-600 py-2 px-3 text-sm focus:ring-2 focus:ring-emerald-400 focus:outline-none dark:bg-slate-700 dark:text-white">
        </div>

        <!-- Adresse -->
        <div>
            <label class="block text-sm font-medium text-slate-700 dark:text-slate-200 text-left">
                Adresse <span class="text-rose-500">*</span>
            </label>
            <input type="text" name="adresse" value="{{ $pharmacie->adresse }}" required
                class="mt-1 block w-full rounded-lg border border-slate-300 dark:border-slate-600 py-2 px-3 text-sm focus:ring-2 focus:ring-emerald-400 focus:outline-none dark:bg-slate-700 dark:text-white">
        </div>

        <!-- Téléphone -->
        <div>
            <label class="block text-sm font-medium text-slate-700 dark:text-slate-200 text-left">
                Téléphone <span class="text-rose-500">*</span>
            </label>
            <input type="text" name="telephone" value="{{ $pharmacie->telephone }}" required
                class="mt-1 block w-full rounded-lg border border-slate-300 dark:border-slate-600 py-2 px-3 text-sm focus:ring-2 focus:ring-emerald-400 focus:outline-none dark:bg-slate-700 dark:text-white">
        </div>

        <!-- Indice -->
        <div>
            <label class="block text-sm font-medium text-slate-700 dark:text-slate-200 text-left">
                Indice
            </label>
            <input type="text" name="indice" value="{{ $pharmacie->indice }}"
                class="mt-1 block w-full rounded-lg border border-slate-300 dark:border-slate-600 py-2 px-3 text-sm focus:ring-2 focus:ring-emerald-400 focus:outline-none dark:bg-slate-700 dark:text-white">
        </div>

        <!-- Gérant -->
        <div>
            <label class="block text-sm font-medium text-slate-700 dark:text-slate-200 text-left">
                Gérant
            </label>
            <select name="id_gerant"
                class="mt-1 block w-full rounded-lg border border-slate-300 dark:border-slate-600 py-2 px-3 text-sm focus:ring-2 focus:ring-emerald-400 focus:outline-none dark:bg-slate-700 dark:text-white">
                @foreach ($gerants as $gerant)
                    <option value="{{ $gerant->id_gerant }}" {{ $gerant->id_gerant == $pharmacie->id_gerant ? 'selected' : '' }}>
                        {{ $gerant->user->email }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Boutons -->
        <div class="flex justify-end gap-3 pt-4 border-t">
            <button type="button"
                onclick="document.getElementById('edit-pharmacie-{{ $pharmacie->id_pharmacie }}').close()"
                class="px-4 py-2 text-sm font-medium bg-slate-200 dark:bg-slate-700 text-slate-800 dark:text-slate-200 rounded-lg hover:bg-slate-300 dark:hover:bg-slate-600">
                Annuler
            </button>

            <button type="submit"
                class="px-4 py-2 text-sm font-semibold text-white bg-emerald-600 
                rounded-lg hover:bg-emerald-500 shadow">
                Mettre à jour
            </button>
        </div>
    </form>
</dialog>
