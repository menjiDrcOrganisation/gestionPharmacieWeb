@extends('layouts.main') 
@section('title', 'Gestion  Doses')
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

<div class="w-full px-4 sm:px-6 lg:px-8 py-6 mx-auto">

    <!-- Card Doses -->
    <div class="flex flex-col -mx-3">
        <div class="w-full px-3">
            <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white dark:bg-slate-800 shadow-xl rounded-2xl">

                <!-- Header -->
                <div class="p-4 sm:p-6 border-b border-slate-200 dark:border-slate-700 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 sm:gap-0">
                    
                    <!-- Titre -->
                    <h6 class="dark:text-white text-lg sm:text-xl font-semibold flex items-center gap-2">
                        Gestion des Doses
                    </h6>

                    <!-- Actions (filtre + ajouter) -->
                    <div class="flex flex-col sm:flex-row items-start sm:items-center gap-2 sm:gap-3 w-full sm:w-auto">

                        <!-- Filtrage par unité -->
                        <form method="GET" action="{{ route('doses.index') }}" class="w-full sm:w-auto">
                            <select name="unite" onchange="this.form.submit()"
                                class="w-full sm:w-auto rounded-lg border border-slate-300 px-3 py-2 text-sm focus:ring-2 focus:ring-emerald-400 focus:outline-none dark:bg-slate-700 dark:text-white">
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
                            class="flex items-center justify-center gap-2 rounded-lg bg-blue-600 px-4 py-2 text-sm font-semibold text-white hover:bg-blue-500 shadow w-full sm:w-auto">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                            </svg>
                            Ajouter
                        </button>
                    </div>
                </div>

                <!-- Table -->
                <div class="flex-auto px-0 pt-2 pb-4 overflow-x-auto">
                    <table class="min-w-full table-auto text-slate-500">
                        <thead>
                            <tr class="bg-slate-100 dark:bg-slate-700">
                                <th class="px-4 py-2 text-left text-xs font-bold text-slate-600 dark:text-slate-300 uppercase">Quantité</th>
                                <th class="px-4 py-2 text-left text-xs font-bold text-slate-600 dark:text-slate-300 uppercase">Unité</th>
                                <th class="px-4 py-2 text-center text-xs font-bold text-slate-600 dark:text-slate-300 uppercase">Créée le</th>
                                <th class="px-4 py-2 text-center text-xs font-bold text-slate-600 dark:text-slate-300 uppercase"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($doses as $dose)
                                @if (!request('unite') || request('unite') == $dose->unite)
                                    <tr class="hover:bg-slate-50 dark:hover:bg-slate-700 transition">
                                        <td class="px-4 py-2 text-sm font-light text-slate-700 dark:text-white">{{ $dose->quantite }}</td>
                                        <td class="px-4 py-2 text-sm font-light text-slate-700 dark:text-white">{{ $dose->unite }}</td>
                                        <td class="px-4 py-2 text-center text-sm text-slate-500 dark:text-slate-300">
                                            {{ $dose->created_at->format('d/m/Y') }}
                                        </td>
                                        <td class="px-4 py-2 text-center text-sm flex flex-col sm:flex-row justify-center gap-2">
                                            <!-- Bouton Edit -->
                                            <button command="show-modal" commandfor="edit-dose-{{ $dose->id }}"
                                                class="inline-flex items-center gap-1 px-3 py-1 text-xs font-semibold text-white bg-blue-500 rounded-lg hover:bg-blue-400 shadow">
                                                <img src="https://cdn-icons-png.flaticon.com/512/1828/1828911.png" class="w-3 h-3" alt="edit">
                                                Modifier
                                            </button>
                                            @include('doses.edit')
                                        </td>
                                    </tr>
                                @endif
                            @empty
                                <tr>
                                    <td colspan="4" class="px-4 py-2 text-center text-sm text-slate-400 dark:text-slate-300">
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

    @include('doses.create')

</div>

<script>
document.addEventListener("DOMContentLoaded", () => {
    const alert = document.getElementById("alert-message");
    if (alert) {
        setTimeout(() => {
            alert.style.transition = "opacity 0.5s ease";
            alert.style.opacity = "0";
            setTimeout(() => alert.remove(), 500);
        }, 3000);
    }
});
</script>
@endsection
