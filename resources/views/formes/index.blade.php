@extends('layouts.main')
@section('content')
<div class="bg-white dark:bg-slate-900 w-full px-6 py-6 mx-auto">
    <div class="flex flex-wrap -mx-3">
        <div class="flex-none w-full max-w-full px-3">
            <div class="relative flex flex-col mb-6 bg-white dark:bg-slate-800 shadow-xl rounded-2xl">

                <!-- Header -->
                <div class="p-6 border-b rounded-t-2xl flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                    <h6 class="dark:text-white text-xl font-semibold flex items-center gap-2">
                        {{-- <img src="https://cdn-icons-png.flaticon.com/512/2966/2966489.png" class="w-7 h-7" alt="icon"> --}}
                        Gestion des Formes
                    </h6>

                    <div class="flex flex-wrap items-center gap-3">
                        <!-- Recherche (icône intégrée) -->
                        <div class="relative">
                            <input type="text" id="searchInputForme" placeholder="Rechercher..."
                                   class="w-96 rounded-lg border border-slate-300 pl-9 pr-3 py-2 text-sm focus:ring-2 focus:ring-emerald-400 focus:outline-none dark:bg-slate-700 dark:text-white">
                            <span class="absolute left-2.5 top-2.5">
                                <img src="https://cdn-icons-png.flaticon.com/512/149/149852.png" class="w-4 h-4 opacity-70" alt="search">
                            </span>
                        </div>

                        <!-- Bouton Ajouter (bleu) -->
                        <button command="show-modal" commandfor="dialog_forme"
                                class="flex items-center gap-2 rounded-lg bg-blue-600 px-4 py-2 text-sm font-semibold text-white hover:bg-blue-500 shadow">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M12 4v16m8-8H4"/>
                                </svg>
                            Ajouter
                        </button>
                    </div>
                </div>

                @include('formes.create')

                <!-- Table -->
                <div class="flex-auto px-0 pt-4 pb-2">
                    <div class="overflow-x-auto max-h-[500px] overflow-y-auto">
                        <table id="formeTable"
                               class="min-w-full border-collapse text-slate-600 dark:text-slate-200">
                            <thead>
                                <tr class="bg-slate-50 dark:bg-slate-700/50 sticky top-0 z-10">
                                    <th class="px-6 py-3 text-left text-xs font-bold uppercase">Nom</th>
                                    <th class="px-6 py-3 text-center text-xs font-bold uppercase">Créé le</th>
                                    <th class="px-6 py-3 text-center text-xs font-bold uppercase"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($formes as $forme)
                                <tr class="hover:bg-slate-50 dark:hover:bg-slate-700/70 transition">
                                    <td class="p-4 border-b dark:border-slate-600">
                                        <div class="flex items-center gap-3">
                                            <img src="{{ asset('assets/img/logo.png') }}" class="w-6 h-6" alt="logo" />
                                            <span class="text-sm font-light">{{ ucfirst(strtolower($forme->nom))}}</span>
                                        </div>
                                    </td>
                                    <td class="p-4 text-center border-b dark:border-slate-600">
                                        <span class="text-xs font-light text-slate-500 dark:text-slate-300">{{ $forme->created_at->format('d/m/Y') }}</span>
                                    </td>
                                    <td class="p-4 text-center border-b dark:border-slate-600">
                                        <button command="show-modal" commandfor="edit-forme-{{ $forme->id_forme }}"
                                                class="flex items-center gap-1 px-3 py-1 text-xs font-semibold text-white bg-blue-500 rounded-lg hover:bg-blue-400">
                                            <img src="https://cdn-icons-png.flaticon.com/512/1828/1828911.png" class="w-3 h-3" alt="edit">
                                            Modifier
                                        </button>
                                        @include('formes.edit')
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('searchInputForme').addEventListener('keyup', function () {
    const filter = this.value.toLowerCase();
    const rows = document.querySelectorAll('#formeTable tbody tr');

    rows.forEach(row => {
        const text = row.textContent.toLowerCase();
        row.style.display = text.includes(filter) ? '' : 'none';
    });
});
</script>
@endsection
