<!-- Modal Create -->
<div id="modal-create" class="fixed inset-0 flex items-center justify-center bg-black/50 hidden z-50">
    <div class="bg-white dark:bg-slate-800 rounded-lg w-full max-w-md p-6">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-semibold dark:text-white">Ajouter une dose</h3>
            <button onclick="document.getElementById('modal-create').classList.add('hidden')"
                class="text-slate-500 hover:text-slate-700 dark:hover:text-white">&times;</button>
        </div>
        <form action="{{ route('doses.store') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-medium text-slate-700 dark:text-white">Quantité <span
                        class="text-rose-500">*</span></label>
                <input type="number" name="quantite" required
                    class="mt-1 block w-full rounded-md border border-slate-300 py-2 px-3 focus:ring-2 focus:ring-blue-400 dark:bg-slate-700 dark:text-white">
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700 dark:text-white">Unité <span
                        class="text-rose-500">*</span></label>
                <select name="unite" required
                    class="mt-1 block w-full rounded-md border border-slate-300 py-2 px-3 focus:ring-2 focus:ring-blue-400 dark:bg-slate-700 dark:text-white">
                    <option value="">Sélectionnez une unité</option>
                    <option value="mg">mg</option>
                    <option value="g">g</option>
                    <option value="ml">ml</option>
                    <option value="unités">unités</option>
                </select>
            </div>
            <div class="flex justify-end space-x-2">
                <button type="button" onclick="document.getElementById('modal-create').classList.add('hidden')"
                    class="px-4 py-2 bg-gray-300 dark:bg-slate-600 rounded hover:bg-gray-400 dark:hover:bg-slate-500">Annuler</button>
                <button type="submit"
                    class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-400">Ajouter</button>
            </div>
        </form>
    </div>
</div>