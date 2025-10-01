@extends('layouts.main') 
@section('content')

@if (session('success'))
    <div id="alert-message" class="mb-4 p-3 rounded-lg bg-green-100 text-green-800 shadow">
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div id="alert-message" class="mb-4 p-3 rounded-lg bg-red-100 text-red-800 shadow">
        {{ session('error') }}
    </div>
@endif

@if (session('info'))
    <div id="alert-message" class="mb-4 p-3 rounded-lg bg-blue-100 text-blue-800 shadow">
        {{ session('info') }}
    </div>
@endif


<div class="w-full px-6 py-6 mx-auto">

    <!-- Card Doses -->
    <div class="flex flex-wrap -mx-3">
        <div class="flex-none w-full max-w-full px-3">
            <div
                class="relative flex flex-col min-w-0 mb-6 break-words bg-white dark:bg-slate-800 shadow-xl rounded-2xl">

                <!-- Header -->
                <div class="p-6 border-b border-slate-200 dark:border-slate-700 flex justify-between items-center">
                    
                    <!-- Titre -->
                    <h6 class="dark:text-white text-xl font-semibold flex items-center gap-2">
                        {{-- <img src="https://cdn-icons-png.flaticon.com/512/2966/2966489.png" class="w-7 h-7" alt="icon">  --}}
                        Gestion des Doses
                    </h6>

                    <!-- Actions (filtre + ajouter) -->
                    <div class="flex items-center gap-3">
                        <!-- Filtrage par unité -->
                        <form method="GET" action="{{ route('doses.index') }}">
                            <select name="unite" onchange="this.form.submit()"
                                class="rounded-lg border border-slate-300 px-3 py-2 text-sm focus:ring-2 focus:ring-emerald-400 focus:outline-none dark:bg-slate-700 dark:text-white">
                                <option value="">Toutes les unités</option>
                                @php
                                    $unites = $doses->pluck('unite')->unique();
                                @endphp
                                @foreach ($unites as $unite)
                                    <option value="{{ $unite }}" {{ request('unite') == $unite ? 'selected' : '' }}>
                                        {{ strtoupper($unite) }}
                                    </option>
                                @endforeach
                            </select>
                        </form>

                        <!-- Bouton Ajouter -->
                        <button onclick="document.getElementById('modal_medoc').classList.remove('hidden')"
                            class="flex items-center gap-2 rounded-lg bg-blue-600 px-4 py-2 text-sm font-semibold text-white hover:bg-blue-500 shadow">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M12 4v16m8-8H4"/>
                            </svg>
                            Ajouter
                        </button>
                    </div>
                </div>

                <!-- Table -->
                <div class="flex-auto px-0 pt-2 pb-4">
                    <div class="p-0 overflow-x-auto">
                        <table class="items-center w-full mb-0 border-collapse text-slate-500">
                            <thead>
                                <tr class="bg-slate-100 dark:bg-slate-700">
                                    <th class="px-6 py-3 text-left text-xs font-bold text-slate-600 dark:text-slate-300 uppercase">Quantité</th>
                                    <th class="px-6 py-3 text-left text-xs font-bold text-slate-600 dark:text-slate-300 uppercase">Unité</th>
                                    <th class="px-6 py-3 text-center text-xs font-bold text-slate-600 dark:text-slate-300 uppercase">Créée le</th>
                                    <th class="px-6 py-3 text-center text-xs font-bold text-slate-600 dark:text-slate-300 uppercase"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($doses as $dose)
                                    @if (!request('unite') || request('unite') == $dose->unite)
                                        <tr class="hover:bg-slate-50 dark:hover:bg-slate-700 transition">
                                            <td class="px-6 py-3 text-sm font-light  text-slate-700 dark:text-white">{{ $dose->quantite }}</td>
                                            <td class="px-6 py-3 text-sm  font-light text-slate-700 dark:text-white">{{ $dose->unite }}</td>
                                            <td class="px-6 py-3 text-center text-sm text-slate-500 dark:text-slate-300">
                                                {{ $dose->created_at->format('d/m/Y') }}
                                            </td>
                                            <td class="px-6 py-3 text-center text-sm flex justify-center gap-2">
                                                
                                                <!-- Bouton Edit -->
                                                <button command="show-modal" commandfor="edit-dose-{{ $dose->id }}"
                                                    class="inline-flex items-center gap-1 px-3 py-1 text-xs font-semibold text-white bg-blue-500 rounded-lg hover:bg-blue-400 shadow">
                                                    <img src="https://cdn-icons-png.flaticon.com/512/1828/1828911.png" class="w-3 h-3" alt="edit">
                                                    Modifier
                                                </button>
                                                @include('doses.edit')

                                                <!-- Bouton Supprimer -->
                                                {{-- <button type="button"
                                                    onclick="document.getElementById('delete-dose-{{ $dose->id }}').showModal()"
                                                    class="inline-flex items-center gap-1 px-3 py-1 text-xs font-semibold text-white bg-red-600 rounded-lg hover:bg-red-500 shadow">
                                                    🗑 Supprimer
                                                </button> --}}

                                                <!-- Modal Delete -->
                                                <dialog id="delete-dose-{{ $dose->id }}"
                                                    class="p-6 bg-white dark:bg-slate-800 rounded-2xl shadow-xl w-full max-w-md">
                                                    <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100 mb-4">
                                                        Confirmation
                                                    </h3>
                                                    <p class="text-sm text-gray-600 dark:text-gray-300 mb-6">
                                                        Voulez-vous vraiment supprimer cette dose ?<br>
                                                        Cette action est <span class="font-bold text-red-500">irréversible</span>.
                                                    </p>
                                                    <div class="flex justify-end gap-3">
                                                        <button type="button"
                                                            onclick="document.getElementById('delete-dose-{{ $dose->id }}').close()"
                                                            class="px-4 py-2 text-sm bg-gray-200 dark:bg-slate-700 text-gray-800 dark:text-gray-200 rounded-lg hover:bg-gray-300 dark:hover:bg-slate-600">
                                                            Annuler
                                                        </button>
                                                        <form action="{{ route('doses.destroy', $dose->id_dose) }}" method="POST" class="inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="px-4 py-2 text-sm font-semibold text-white bg-red-600 rounded-lg hover:bg-red-500 shadow">
                                                                Confirmer
                                                            </button>
                                                        </form>
                                                    </div>
                                                </dialog>
                                            </td>
                                        </tr>
                                    @endif
                                @empty
                                    <tr>
                                        <td colspan="4"
                                            class="px-6 py-3 text-center text-sm text-slate-400 dark:text-slate-300">
                                            🚫 Aucune dose enregistrée.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>

    @include('doses.create')

</div>

  <script>
    document.addEventListener("DOMContentLoaded", () => {
        const alert = document.getElementById("alert-message");
        if (alert) {
            setTimeout(() => {
                alert.style.transition = "opacity 0.5s ease";
                alert.style.opacity = "0";
                setTimeout(() => alert.remove(), 500); // Supprime après animation
            }, 3000); // 3 secondes
        }
    });
</script>
@endsection
