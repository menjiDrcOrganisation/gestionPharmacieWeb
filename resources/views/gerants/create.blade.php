<!-- Modal -->
<dialog id="add-gerant-dialog"
    class="rounded-2xl shadow-xl w-full max-w-md p-0 bg-gray-800 dark:bg-slate-800">
    <form method="POST" action="{{ route('gerants.store') }}" class="flex flex-col">
        @csrf
        <!-- Header -->
        {{-- <div
            class="flex items-center justify-between px-6 py-4 border-b bg-blue-600 rounded-t-2xl">
            <h3 class="text-lg font-semibold text-white flex items-center gap-2">
                <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png" class="w-5 h-5" alt="icon">
                Ajouter un gérant
            </h3>
            <button type="button" onclick="document.getElementById('add-gerant-dialog').close();"
                class="text-white hover:text-gray-200">
                ✕
            </button>
        </div> --}}

        <div class="bg-gray-800 px-6 py-4 border-b border-gray-700 flex items-center gap-3">
            <div class="flex items-center justify-center w-10 h-10 rounded-full bg-emerald-500/10">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"
                    class="w-6 h-6 text-emerald-400" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
            </div>
            <h3 id="dialog-title" class="text-lg font-semibold text-white">
                Ajouter un gérant
            </h3>
        </div>

        <!-- Body -->
        <div class="p-6 space-y-5">
            <!-- Nom -->
            <div>
                <label for="name"
                    class="block text-sm font-medium dark:text-slate-200 text-white">Nom<span class="text-rose-500">*</span></label>
                <input type="text" name="name" id="name" required
                    class="mt-1 block w-full px-3 py-2 text-sm border border-slate-300 dark:border-slate-600 rounded-lg focus:ring-2 focus:ring-emerald-400 focus:outline-none dark:bg-slate-700 dark:text-white">
            </div>

            <!-- Email -->
            <div>
                <label for="email"
                    class="block text-sm font-medium dark:text-slate-200 text-white">Email<span class="text-rose-500">*</span></label>
                <input type="email" name="email" id="email" required
                    class="mt-1 block w-full px-3 py-2 text-sm border border-slate-300 dark:border-slate-600 rounded-lg focus:ring-2 focus:ring-emerald-400 focus:outline-none dark:bg-slate-700 dark:text-white">
            </div>

            <!-- Statut (optionnel) -->
            {{-- 
            <div>
                <label for="statut"
                    class="block text-sm font-medium text-slate-700 dark:text-slate-200">Statut</label>
                <select name="statut" id="statut" required
                    class="mt-1 block w-full px-3 py-2 text-sm border border-slate-300 dark:border-slate-600 rounded-lg focus:ring-2 focus:ring-emerald-400 focus:outline-none dark:bg-slate-700 dark:text-white">
                    <option value="actif">Actif</option>
                    <option value="inactif">Inactif</option>
                </select>
            </div>
            --}}
        </div>

        <!-- Footer -->
        <div
            class="flex justify-end gap-3 px-6 py-4 bg-gray-800 dark:bg-slate-700 rounded-b-2xl">
            <button type="button" onclick="document.getElementById('add-gerant-dialog').close();"
                class="px-4 py-2 text-sm font-medium bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 dark:bg-slate-600 dark:text-white dark:hover:bg-slate-500">
                Annuler
            </button>
            <button type="submit"
                class="px-4 py-2 text-sm font-semibold bg-emerald-600 text-white rounded-lg hover:bg-emerald-500 shadow">
                Enregistrer
            </button>
        </div>
    </form>
</dialog>
