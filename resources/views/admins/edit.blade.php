<dialog id="edit-admin-{{ $aadmin->id_admin }}" 
    class="bg-transparent w-full max-w-lg rounded-2xl p-0 backdrop:bg-black/40">

    <form action="{{ route('admins.update', $aadmin->id_admin) }}" method="POST" 
        class="flex flex-col bg-white dark:bg-slate-800 rounded-2xl shadow-xl">
        @csrf
        @method('PUT')

        <!-- Header -->
        <div class="flex items-center justify-between px-5 py-4 border-b dark:border-slate-700 rounded-t-2xl">
            <h2 class="text-lg font-semibold flex items-center gap-2">
                <img src="https://cdn-icons-png.flaticon.com/512/2966/2966489.png" alt="icon" class="w-6 h-6">
                Modifier l’administrateur
            </h2>
            <button type="button" 
                onclick="document.getElementById('edit-admin-{{ $aadmin->id_admin }}').close()"
                class="text-white hover:text-gray-200 text-xl leading-none">&times;</button>
        </div>

        <!-- Body -->
        <div class="p-6 space-y-5">
            <!-- Nom -->
            <div>
                <label for="name-{{ $aadmin->id_admin }}" class="block text-sm font-medium text-slate-700 dark:text-slate-300 text-left">
                    Nom
                </label>
                <input type="text" name="name" id="name-{{ $aadmin->id_admin }}" 
                    value="{{ $aadmin->user->name }}"
                    class="mt-1 block w-full rounded-lg border border-slate-300 dark:border-slate-600 
                    bg-white dark:bg-slate-700 dark:text-white px-3 py-2 text-sm 
                    focus:ring-2 focus:ring-emerald-400 focus:outline-none" required>
            </div>

            <!-- Email -->
            <div>
                <label for="email-{{ $aadmin->id_admin }}" class="block text-sm font-medium text-slate-700 dark:text-slate-300 text-left">
                    Email
                </label>
                <input type="email" name="email" id="email-{{ $aadmin->id_admin }}" 
                    value="{{ $aadmin->user->email }}"
                    class="mt-1 block w-full rounded-lg border border-slate-300 dark:border-slate-600 
                    bg-white dark:bg-slate-700 dark:text-white px-3 py-2 text-sm 
                    focus:ring-2 focus:ring-emerald-400 focus:outline-none" required>
            </div>
        </div>

        <!-- Footer -->
        <div class="flex justify-end gap-3 px-5 py-4 border-t dark:border-slate-700 rounded-b-2xl bg-slate-50 dark:bg-slate-800">
            <button type="button"
                onclick="document.getElementById('edit-admin-{{ $aadmin->id_admin }}').close()"
                class="px-4 py-2 text-sm font-medium text-slate-700 dark:text-slate-300 
                bg-gray-200 dark:bg-slate-600 rounded-lg hover:bg-gray-300 dark:hover:bg-slate-500">
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
