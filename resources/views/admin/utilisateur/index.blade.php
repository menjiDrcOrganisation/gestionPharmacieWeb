<x-app-layout>
    <h1 class="text-2xl font-bold mb-4">Gestion des utilisateurs</h1>
    <a href="{{ route('utilisateurs.create') }}" 
       class="px-4 py-2 bg-blue-600 text-white rounded">Ajouter</a>

    <table class="w-full mt-4 border">
        <thead class="bg-gray-100">
            <tr>
                <th class="px-4 py-2">Nom</th>
                <th class="px-4 py-2">Email</th>
                <th class="px-4 py-2">Rôle</th>
                <th class="px-4 py-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr class="border-b">
                <td class="px-4 py-2">{{ $user->nom }} {{ $user->prenom }}</td>
                <td class="px-4 py-2">{{ $user->email }}</td>
                <td class="px-4 py-2">{{ $user->role }}</td>
                <td class="px-4 py-2">
                    <a href="{{ route('utilisateurs.edit', $user) }}" 
                       class="text-blue-600">Modifier</a> | 
                    <form action="{{ route('utilisateurs.destroy', $user) }}" method="POST" class="inline">
                        @csrf @method('DELETE')
                        <button class="text-red-600" onclick="return confirm('Supprimer ?')">Supprimer</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</x-app-layout>
