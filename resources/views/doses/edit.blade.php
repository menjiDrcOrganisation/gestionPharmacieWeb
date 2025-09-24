<!-- Modal Edit -->
<dialog id="edit-dose-{{ $dose->id }}" class="p-6 bg-white dark:bg-slate-800 rounded-2xl shadow-xl w-full max-w-md">

    <div class="flex items-center gap-3 border-b pb-3 mb-4">
        <img src="https://cdn-icons-png.flaticon.com/512/2966/2966489.png" alt="icon" class="w-6 h-6">
        <h3 class="text-lg font-semibold text-slate-800 dark:text-slate-100">
            Modifier la dose
        </h3>
    </div>
  
    <form action="{{ route('doses.update', $dose->id_dose) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <!-- Quantité -->
        <div>
            <label class="block text-sm font-medium text-slate-600 dark:text-slate-300 text-left">
                Quantité <span class="text-rose-500">*</span>
            </label>
            <input type="text" name="quantite" value="{{ $dose->quantite }}" required 
            class="mt-1 block w-full rounded-lg border border-slate-300 dark:border-slate-600 py-2 px-3 text-sm focus:ring-2 focus:ring-emerald-400 focus:outline-none dark:bg-slate-700 dark:text-white">
        </div>

        <!-- Unité -->
        <div>
            <label class="block text-sm font-medium text-slate-600 dark:text-slate-300 text-left">
                Unité <span class="text-rose-500">*</span>
            </label>
            <input type="text" name="unite" value="{{ $dose->unite }}" required class="mt-1 block w-full rounded-lg border border-slate-300 dark:border-slate-600 py-2 px-3 text-sm focus:ring-2 focus:ring-emerald-400 focus:outline-none dark:bg-slate-700 dark:text-white">
        </div>

        <!-- Boutons -->
        <div class="flex justify-end gap-2 pt-4">
            <button type="button" command="close" commandfor="edit-dose-{{ $dose->id }}"
                class="px-4 py-2 rounded-md bg-slate-200 text-slate-800 hover:bg-slate-300 dark:bg-slate-700 dark:text-white">
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