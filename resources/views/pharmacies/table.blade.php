<!-- resources/views/pharmacies/table.blade.php -->

<div class="overflow-x-auto rounded-lg shadow">
    <table class="min-w-full bg-white border border-gray-200">
        <thead class="bg-gray-100">
            <tr>
                <th class="px-4 py-2 border-b text-left text-sm font-semibold text-gray-700">ID</th>
                <th class="px-4 py-2 border-b text-left text-sm font-semibold text-gray-700">Nom</th>
                <th class="px-4 py-2 border-b text-left text-sm font-semibold text-gray-700">Adresse</th>
                <th class="px-4 py-2 border-b text-left text-sm font-semibold text-gray-700">Téléphone</th>
                <th class="px-4 py-2 border-b text-left text-sm font-semibold text-gray-700">Gérant</th>
                <th class="px-4 py-2 border-b text-center text-sm font-semibold text-gray-700">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($pharmacies as $pharmacie)
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-2 border-b text-sm text-gray-600">{{ $pharmacie->id }}</td>
                    <td class="px-4 py-2 border-b text-sm text-gray-600">{{ $pharmacie->nom }}</td>
                    <td class="px-4 py-2 border-b text-sm text-gray-600">{{ $pharmacie->adresse }}</td>
                    <td class="px-4 py-2 border-b text-sm text-gray-600">{{ $pharmacie->telephone }}</td>
                    <td class="px-4 py-2 border-b text-sm text-gray-600">
                        {{ $pharmacie->gerant ? $pharmacie->gerant->user->name : 'Aucun' }}
                    </td>
                    <td class="px-4 py-2 border-b text-center text-sm">
                        <button command="show-modal" commandfor="edit-pharmacie-{{ $pharmacie->id }}"
                            class="px-3 py-1 text-xs font-semibold text-white bg-blue-500 rounded hover:bg-blue-400">
                            ✏️ Edit
                        </button>

                        {{-- <form action="{{ route('pharmacies.destroy', $pharmacie->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                onclick="return confirm('Voulez-vous vraiment supprimer cette pharmacie ?')"
                                class="px-3 py-1 text-xs font-semibold text-white bg-red-500 rounded hover:bg-red-400">
                                🗑️ Supprimer
                            </button>
                        </form> --}}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="px-4 py-2 text-center text-gray-500">
                        Aucune pharmacie trouvée.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
