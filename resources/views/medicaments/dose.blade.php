<dialog id="dialog-create-dose" class="backdrop:bg-black/50 rounded-lg w-full max-w-md p-6">
    <h3 class="text-lg font-semibold dark:text-white mb-4">Ajouter une dose</h3>

    <form id="form-dose" action="{{ route('doses.store') }}" method="POST" class="space-y-4">
        @csrf
        <div>
            <label class="block text-sm font-medium">Quantité</label>
            <input type="number" name="quantite" required
                class="w-full rounded border px-2 py-1 dark:bg-slate-700 dark:text-white">
        </div>

        <div>
            <label class="block text-sm font-medium">Unité</label>
            <select name="unite" required
                class="w-full rounded border px-2 py-1 dark:bg-slate-700 dark:text-white">
                <option value="mg">mg</option>
                <option value="g">g</option>
                <option value="ml">ml</option>
                <option value="unités">unités</option>
            </select>
        </div>

        <div class="flex justify-end space-x-2">
            <button type="button" onclick="document.getElementById('dialog-create-dose').close()"
                class="px-3 py-1 bg-gray-300 rounded">Annuler</button>
            <button type="submit" class="px-3 py-1 bg-blue-600 text-white rounded">Ajouter</button>
        </div>
    </form>
</dialog>
