<!-- Modal Edit -->
<dialog id="edit-dose-{{ $dose->id }}" class="p-6 bg-white dark:bg-slate-800 rounded-2xl shadow-xl w-full max-w-md">

    <h2 class="text-lg font-semibold mb-4 text-slate-700 dark:text-white">
        Modifier la dose
    </h2>

    <form action="{{ route('doses.update', $dose->id) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <!-- Quantité -->
        <div>
            <label class="block text-sm font-medium text-slate-600 dark:text-slate-300">
                Quantité <span class="text-rose-500">*</span>
            </label>
            <input type="text" name="quantite" value="{{ $dose->quantite }}" required class="mt-1 block w-full rounded-md border border-slate-300 py-2 px-3
                       dark:bg-slate-700 dark:text-white focus:ring-2 focus:ring-emerald-400">
        </div>

        <!-- Unité -->
        <div>
            <label class="block text-sm font-medium text-slate-600 dark:text-slate-300">
                Unité <span class="text-rose-500">*</span>
            </label>
            <input type="text" name="unite" value="{{ $dose->unite }}" required class="mt-1 block w-full rounded-md border border-slate-300 py-2 px-3
                       dark:bg-slate-700 dark:text-white focus:ring-2 focus:ring-emerald-400">
        </div>

        <!-- Boutons -->
        <div class="flex justify-end gap-2 pt-4">
            <button type="button" command="close" commandfor="edit-dose-{{ $dose->id }}"
                class="px-4 py-2 rounded-md bg-slate-200 text-slate-800 hover:bg-slate-300 dark:bg-slate-700 dark:text-white">
                Annuler
            </button>
            <button type="submit" class="px-4 py-2 rounded-md bg-emerald-500 text-white hover:bg-emerald-600">
                ✅ Enregistrer
            </button>
        </div>
    </form>
</dialog>