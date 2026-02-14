<!-- Modal -->
<dialog id="add-admin-dialogg" class="bg-transparent w-full max-w-md rounded-2xl p-0 backdrop:bg-black/40">
    <form method="POST" action="{{ route('admins.store') }}" class="flex flex-col bg-white rounded-2xl shadow-xl">
        @csrf

        <!-- Header -->
        <div class="bg-white px-6 py-4 border-b border-gray-200 flex items-center gap-3">
            <div class="flex items-center justify-center w-10 h-10 rounded-full bg-emerald-100">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"
                    class="w-6 h-6 text-emerald-600" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
            </div>
            <h3 id="dialog-title" class="text-lg font-semibold text-gray-800">
                Ajouter un administrateur
            </h3>
        </div>

        <!-- Body -->
        <div class="p-6 space-y-5">
            <!-- Nom -->
            <div>
                <label for="name" class="block text-sm font-medium text-gray-800">Nom</label>
                <input type="text" name="name" id="name" required
                    class="mt-1 block w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm text-gray-800 focus:ring-2 focus:ring-emerald-400 focus:outline-none">
            </div>

            <!-- Email -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-800">Email</label>
                <input type="email" name="email" id="email" required
                    class="mt-1 block w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm text-gray-800 focus:ring-2 focus:ring-emerald-400 focus:outline-none">
            </div>

            <!-- Rôle caché -->
            <input type="hidden" name="role" value="admin">
        </div>

        <!-- Footer -->
        <div class="flex justify-end gap-3 px-5 py-4 border-t border-gray-200 rounded-b-2xl bg-gray-50">
            <button type="button" onclick="document.getElementById('add-admin-dialogg').close();"
            class="px-4 py-2 text-sm font-semibold rounded-md bg-gray-100 text-gray-800 hover:bg-gray-200">
                Annuler
            </button>
            <button type="submit"
                class="px-4 py-2 text-sm font-semibold text-white bg-emerald-600 rounded-lg hover:bg-emerald-500 shadow">
                Enregistrer
            </button>
        </div>
    </form>
</dialog>
