<dialog id="edit-admin-{{ $aadmin->id_admin }}"
    class="bg-blue-500 dark:bg-slate-800 rounded-2xl p-0 w-full max-w-lg backdrop:bg-black/40">

    <!-- Header -->
    <div class="flex items-center justify-between px-6 py-4 border-b dark:border-slate-700">
        <h2 class="text-lg font-medium dark:text-white">Modifier l'Admin</h2>
        <button type="button" onclick="document.getElementById('edit-admin-{{ $aadmin->id_admin }}').close()"
            class="text-slate-500 hover:text-slate-700">
            ✕
        </button>
    </div>

    <!-- Body -->
    <div class="px-6 py-6">
        <form action="{{ route('admins.update', $aadmin->id_admin) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <!-- Nom -->
            <div>
                <label for="name-{{ $aadmin->id_admin }}" class="block text-sm font-medium">Nom</label>
                <input type="text" name="name" id="name-{{ $aadmin->id_admin }}"
                    value="{{ $aadmin->user->name }}"
                    class="mt-1 block w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500" required>
            </div>

            <!-- Email -->
            <div>
                <label for="email-{{ $aadmin->id_admin }}" class="block text-sm font-medium">Email</label>
                <input type="email" name="email" id="email-{{ $aadmin->id_admin }}"
                    value="{{ $aadmin->user->email }}"
                    class="mt-1 block w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500" required>
            </div>

            <!-- Boutons -->
            <div class="flex justify-end space-x-3 pt-4">
                <button type="button"
                    onclick="document.getElementById('edit-admin-{{ $aadmin->id_admin }}').close()"
                    class="px-4 py-2 bg-slate-300 rounded-lg hover:bg-slate-400">
                    Annuler
                </button>
                <button type="submit"
                    class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-500">
                    Mettre à jour
                </button>
            </div>
        </form>
    </div>
</dialog>
