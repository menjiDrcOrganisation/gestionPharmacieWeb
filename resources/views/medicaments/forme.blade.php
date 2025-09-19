

<!-- Modal Forme -->
<div id="modal-forme" class="fixed inset-0 flex items-center justify-center bg-black/50 hidden z-50">
    <div class="bg-slate-900 rounded-lg w-full max-w-md p-6">
        <!-- Header -->
        <div class="flex justify-between items-center border-b border-slate-700 pb-3">
            <h3 class="text-lg font-semibold text-white">Ajouter une Forme</h3>
            <button onclick="closeModalForme()" class="text-white text-xl font-bold">&times;</button>
        </div>

        <!-- Formulaire -->
        <form id="form-forme" action="{{ route('formes.store') }}" method="POST" class="mt-4 space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-medium text-white">Nom <span class="text-rose-500">*</span></label>
                <input type="text" name="nom" required
                    class="mt-1 block w-full rounded-md border border-slate-600 bg-slate-800 text-white py-2 px-3 focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label class="block text-sm font-medium text-white">Description</label>
                <textarea name="description" rows="3"
                    class="mt-1 block w-full rounded-md border border-slate-600 bg-slate-800 text-white py-2 px-3 focus:ring-2 focus:ring-blue-500"></textarea>
            </div>

            <!-- Actions -->
            <div class="flex justify-end gap-3 pt-2">
                <button type="button" onclick="closeModalForme()"
                    class="px-4 py-2 bg-slate-700 text-white rounded hover:bg-slate-600">Annuler</button>
                <button type="submit"
                    class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-500">Ajouter</button>
            </div>
        </form>
    </div>
</div>

<!-- JS -->
<script>
function openModalForme() {
    document.getElementById('modal-forme').classList.remove('hidden');
}
function closeModalForme() {
    document.getElementById('modal-forme').classList.add('hidden');
}
</script>
