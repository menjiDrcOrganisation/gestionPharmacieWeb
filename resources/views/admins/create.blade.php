<!-- Modal -->
<dialog id="add-admin-dialogg" class="bg-transparent w-full max-w-md rounded-2xl p-0 backdrop:bg-black/40 bg-gray-800">
    <form method="POST" action="{{ route('admins.store') }}" class="flex flex-col bg-gray-800 dark:bg-slate-800 rounded-2xl shadow-xl">
        @csrf

        <!-- Header -->
        <div class="bg-gray-800 px-6 py-4 border-b border-gray-700 flex items-center gap-3">
            <div class="flex items-center justify-center w-10 h-10 rounded-full bg-emerald-500/10">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"
                    class="w-6 h-6 text-emerald-400" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
            </div>
            <h3 id="dialog-title" class="text-lg font-semibold text-white">
                Ajouter un administrateur
            </h3>
        </div>

        <!-- Body -->
        <div class="p-6 space-y-5">
            <!-- Nom -->
            <div>
                <label for="name" class="block text-sm font-medium text-white dark:text-slate-300">Nom</label>
                <input type="text" name="name" id="name" required
                    class="mt-1 block w-full rounded-lg border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 dark:text-white px-3 py-2 text-sm focus:ring-2 focus:ring-emerald-400 focus:outline-none">
            </div>

            <!-- Email -->
            <div>
                <label for="email" class="block text-sm font-medium text-white dark:text-slate-300">Email</label>
                <input type="email" name="email" id="email" required
                    class="mt-1 block w-full rounded-lg border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 dark:text-white px-3 py-2 text-sm focus:ring-2 focus:ring-emerald-400 focus:outline-none">
            </div>

            <!-- Rôle caché -->
            <input type="hidden" name="role" value="admin">
        </div>

        <!-- Footer -->
        <div class="flex justify-end gap-3 px-5 py-4 dark:border-slate-700 rounded-b-2xl bg-gray-800 dark:bg-slate-800">
            <button type="button" onclick="document.getElementById('add-admin-dialogg').close();"
            class="px-4 py-2 text-sm font-semibold rounded-md bg-white/10 text-white hover:bg-white/20">
                Annuler
            </button>
            <button type="submit"
                class="px-4 py-2 text-sm font-semibold text-white bg-emerald-600 rounded-lg hover:bg-emerald-500 shadow">
                Enregistrer
            </button>
        </div>
    </form>
</dialog>
