<!-- Modal Edit Gérant -->
<dialog id="edit-gerant-{{ $gerant->id_gerant }}"
    class="rounded-2xl shadow-xl w-full max-w-lg p-0 bg-white dark:bg-slate-800 backdrop:bg-black/40">
    
    <!-- Header -->
    <div class="flex items-center justify-between px-6 pt-4 border-b bg-white rounded-t-2xl">
        <h2 class="text-lg font-semibold text-dark flex items-center gap-2">
            <img src="https://cdn-icons-png.flaticon.com/512/2966/2966489.png" alt="icon" class="w-6 h-6">
            Modifier le gérant
        </h2>
        <button type="button" onclick="document.getElementById('edit-gerant-{{ $gerant->id_gerant }}').close();"
            class="text-white hover:text-gray-200">
            ✕
        </button>
    </div>

    <!-- Body -->
    <div class="px-6 py-5">
        <form action="{{ route('gerants.update', $gerant->id_gerant) }}" method="POST" class="space-y-5">
            @csrf
            @method('PUT')

            <!-- Nom -->
            <div>
                <label for="name-{{ $gerant->id_gerant }}"
                    class="block text-sm font-medium text-slate-700 dark:text-slate-200">Nom</label>
                <input type="text" name="name" id="name-{{ $gerant->id_gerant }}" value="{{ $gerant->user->name }}"
                    required
                    class="mt-1 block w-full px-3 py-2 text-sm border border-slate-300 dark:border-slate-600 rounded-lg focus:ring-2 focus:ring-emerald-400 focus:outline-none dark:bg-slate-700 dark:text-white">
            </div>

            <!-- Email -->
            <div>
                <label for="email-{{ $gerant->id_gerant }}"
                    class="block text-sm font-medium text-slate-700 dark:text-slate-200">Email</label>
                <input type="email" name="email" id="email-{{ $gerant->id_gerant }}" value="{{ $gerant->user->email }}"
                    required
                    class="mt-1 block w-full px-3 py-2 text-sm border border-slate-300 dark:border-slate-600 rounded-lg focus:ring-2 focus:ring-emerald-400 focus:outline-none dark:bg-slate-700 dark:text-white">
            </div>

            <!-- Pharmacies associées -->
            <div>
                <label class="block text-sm font-medium text-slate-700 dark:text-slate-200">Pharmacies gérées</label>
                <div class="mt-2 space-y-2 max-h-40 overflow-y-auto border border-slate-300 dark:border-slate-600 rounded-lg p-3 bg-slate-50 dark:bg-slate-700">
                    @foreach($pharmacies as $pharmacie)
                        <label class="flex items-center gap-2">
                            <input type="checkbox" name="pharmacies[]" value="{{ $pharmacie->id_pharmacie }}"
                                @if($gerant->pharmacies->contains($pharmacie->id_pharmacie)) checked @endif
                                class="rounded border-slate-300 dark:border-slate-600 text-blue-600 focus:ring-emerald-400">
                            <span class="text-sm dark:text-slate-200">{{ $pharmacie->nom }} ({{ $pharmacie->adresse }})</span>
                        </label>
                    @endforeach
                </div>
            </div>

            <!-- Footer -->
            <div class="flex justify-end gap-3 pt-4 border-t border-slate-200 dark:border-slate-700">
                <button type="button" onclick="document.getElementById('edit-gerant-{{ $gerant->id_gerant }}').close();"
                    class="px-4 py-2 text-sm font-medium bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 dark:bg-slate-600 dark:text-white dark:hover:bg-slate-500">
                    Annuler
                </button>
                <button type="submit"
                    class="px-4 py-2 text-sm font-semibold bg-emerald-600 text-white rounded-lg hover:bg-emerald-500 shadow">
                    Mettre à jour
                </button>
            </div>
        </form>
    </div>
</dialog>
