<!-- Modal -->
<dialog id="add-gerant-dialog" class=" bg-blue-500 dark:bg-slate-800 srrounded-2xl w-full max-w-md p-0">
    <form method="POST" action="{{ route('gerants.store') }}" class="flex flex-col">
        @csrf
        <!-- Header -->
        <div class="flex items-center justify-between bg-blue-500 text-white p-4 rounded-t-2xl">
            <h3 class="text-lg font-semibold">Ajouter un gérant</h3>
            <button type="button" onclick="document.getElementById('add-gerant-dialog').close();">✕</button>
        </div>

        <!-- Body -->
        <div class="p-6 space-y-4 bg-blue-500 dark:bg-slate-800 sr">
            <!-- Nom -->
            <div>
                <label for="name" class="block text-sm font-medium text-slate-700">Nom</label>
                <input type="text" name="name" id="name" required
                    class="mt-1 block w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-emerald-500 focus:border-emerald-500 sm:text-sm">
            </div>

            <!-- Email -->
            <div>
                <label for="email" class="block text-sm font-medium text-slate-700">Email</label>
                <input type="email" name="email" id="email" required
                    class="mt-1 block w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-emerald-500 focus:border-emerald-500 sm:text-sm">
            </div>

            {{-- <!-- Statut -->
            <div>
                <label for="statut" class="block text-sm font-medium text-slate-700">Statut</label>
                <select name="statut" id="statut" required
                    class="mt-1 block w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-emerald-500 focus:border-emerald-500 sm:text-sm">
                    <option value="actif">Actif</option>
                    <option value="inactif">Inactif</option>
                </select>
            </div> --}}
        </div>

        <!-- Footer -->
        <div class="flex justify-end gap-3 p-4 bg-blue-500 dark:bg-slate-800  rounded-b-2xl">
            <button type="button" onclick="document.getElementById('add-gerant-dialog').close();"
                class="px-4 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400">Annuler</button>
            <button type="submit"
                class="px-4 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-500">Enregistrer</button>
        </div>
    </form>
</dialog>
