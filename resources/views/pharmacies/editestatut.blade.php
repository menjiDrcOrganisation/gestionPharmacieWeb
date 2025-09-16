<!-- Modal Edit Statut -->
<dialog id="edit-statut-{{ $pharmacie->id_pharmacie }}"
    class="p-6 bg-white dark:bg-slate-800 rounded-2xl shadow-xl w-full max-w-md">
    <form method="POST" action="{{ route('pharmacies.update', $pharmacie->id_pharmacie) }}">
        @csrf
        @method('Put')

        <h3 class="text-lg font-semibold text-slate-800 dark:text-white mb-4">Modifier le statut</h3>

        <label class="block text-sm font-medium text-slate-700 dark:text-slate-200 mb-2">Statut</label>
        <select name="statut"
            class="block w-full rounded-md border border-slate-400 py-2 px-3 focus:ring-2 focus:ring-emerald-400 mb-4">
            <option value="valide" {{ $pharmacie->statut == 'valide' ? 'selected' : '' }}>Valide</option>
            <option value="en_attente" {{ $pharmacie->statut == 'en_attente' ? 'selected' : '' }}>En attente</option>
            <option value="ferme" {{ $pharmacie->statut == 'ferme' ? 'selected' : '' }}>Ferme</option>
        </select>

        <div class="flex justify-end space-x-2">
            <button type="button"
                onclick="document.getElementById('edit-statut-{{ $pharmacie->id_pharmacie }}').close()"
                class="px-4 py-2 text-sm font-semibold bg-gray-300 rounded hover:bg-gray-400">
                Annuler
            </button>
            <button type="submit"
                class="px-4 py-2 text-sm font-semibold text-white bg-emerald-500 rounded hover:bg-emerald-400">
                Enregistrer
            </button>
        </div>
    </form>
</dialog>
