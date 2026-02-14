<dialog id="edit-gerant-{{ $gerant->id_gerant }}" class="  bg-blue-500 dark:bg-slate-800 srounded-2xl p-0 w-full max-w-lg backdrop:bg-black/40">
    <div class="flex items-center justify-between px-6 py-4 border-b dark:border-slate-700">
        <h2 class="text-lg font-medium dark:text-white">Modifier le gérant</h2>
        <form method="dialog">
            <button class="text-slate-500 hover:text-slate-700">✕</button>
        </form>
    </div>

    <div class="px-6 py-6">
        <form action="{{ route('gerants.update', $gerant->id_gerant) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <!-- Nom -->
            <div>
                <label for="name-{{ $gerant->id_gerant }}" class="block text-sm font-medium">Nom</label>
                <input type="text" name="name" id="name-{{ $gerant->id_gerant }}" value="{{ $gerant->user->name }}"
                       class="mt-1 block w-full border rounded-lg px-3 py-2" required>
            </div>

            <!-- Email -->
            <div>
                <label for="email-{{ $gerant->id_gerant }}" class="block text-sm font-medium">Email</label>
                <input type="email" name="email" id="email-{{ $gerant->id_gerant }}" value="{{ $gerant->user->email }}"
                       class="mt-1 block w-full border rounded-lg px-3 py-2" required>
            </div>

            <!-- Pharmacies associées -->
            <div>
                <label class="block text-sm font-medium">Pharmacies gérées</label>
                <div class="mt-2 space-y-2 max-h-40 overflow-y-auto border rounded p-2">
                    @foreach($pharmacies as $pharmacie)
                        <label class="flex items-center space-x-2">
                            <input type="checkbox" name="pharmacies[]" value="{{ $pharmacie->id_pharmacie }}"
                                @if($gerant->pharmacies->contains($pharmacie->id_pharmacie)) checked @endif>
                            <span class="text-sm">{{ $pharmacie->nom }} ({{ $pharmacie->adresse }})</span>
                        </label>
                    @endforeach
                </div>
            </div>

            <!-- Boutons -->
            <div class="flex justify-end space-x-3 pt-4">
                <form method="dialog">
                    <button type="submit" class="px-4 py-2 bg-slate-300 rounded-lg">Annuler</button>
                </form>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-500">
                    Mettre à jour
                </button>
            </div>
        </form>
    </div>
</dialog>
