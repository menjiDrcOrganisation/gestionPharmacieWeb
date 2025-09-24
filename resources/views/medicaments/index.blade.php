@extends('layouts.main')
@section('title','Médicaments')

@section('content')
<div class="bg-white dark:bg-slate-900 w-full px-6 py-6 mx-auto">
    <div class="flex flex-wrap -mx-3">
        <div class="flex-none w-full max-w-full px-3">
            <div class="relative flex flex-col mb-6 bg-white dark:bg-slate-800 shadow-xl rounded-2xl">

                <!-- Header -->
                <div class="p-6 border-b rounded-t-2xl flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                    <h6 class="dark:text-white text-xl font-semibold flex items-center gap-2">
                        <img src="https://cdn-icons-png.flaticon.com/512/2966/2966489.png" class="w-7 h-7" alt="icon">
                        Gestion des médicaments
                    </h6>

                    <div class="flex flex-wrap items-center gap-3">
                        <!-- Recherche -->
                        <div class="relative">
                            <input type="text" id="searchInput" placeholder="Rechercher..."
                                class="w-72 rounded-lg border border-slate-300 pl-9 pr-3 py-2 text-sm focus:ring-2 focus:ring-emerald-400 focus:outline-none dark:bg-slate-700 dark:text-white">
                            <span class="absolute left-2.5 top-2.5">
                                <img src="https://cdn-icons-png.flaticon.com/512/149/149852.png" class="w-4 h-4 opacity-70" alt="search">
                            </span>
                        </div>

                        <!-- Filtre par forme -->
                        <select id="filterForme"
                            class="rounded-lg border border-slate-300 px-3 py-2 text-sm focus:ring-2 focus:ring-emerald-400 focus:outline-none dark:bg-slate-700 dark:text-white">
                            <option value="">Toutes les formes</option>
                            @foreach($formes as $forme)
                                <option value="{{ strtolower($forme->nom) }}">{{ $forme->nom }}</option>
                            @endforeach
                        </select>

                        <!-- Filtre par dose -->
                        <select id="filterDose"
                            class="rounded-lg border border-slate-300 px-3 py-2 text-sm focus:ring-2 focus:ring-emerald-400 focus:outline-none dark:bg-slate-700 dark:text-white">
                            <option value="">Toutes les doses</option>
                            @foreach($doses as $dose)
                                <option value="{{ strtolower($dose->quantite . ' ' . $dose->unite) }}">
                                    {{ $dose->quantite }} {{ $dose->unite }}
                                </option>
                            @endforeach
                        </select>

                        <!-- Bouton Ajouter -->
                        <button command="show-modal" commandfor="dialog_medoc"
                            class="flex items-center gap-2 rounded-lg bg-blue-600 px-4 py-2 text-sm font-semibold text-white hover:bg-blue-500 shadow">
                            <img src="https://cdn-icons-png.flaticon.com/512/992/992651.png" class="w-4 h-4" alt="add">
                            Ajouter
                        </button>
                    </div>
                </div>

                @include('medicaments.create')

                <!-- Table -->
                <div class="flex-auto px-0 pt-4 pb-2">
                    <div class="overflow-x-auto max-h-[500px] overflow-y-auto">
                        <table id="medicamentTable"
                            class="min-w-full border-collapse text-slate-600 dark:text-slate-200">
                            <thead>
                                <tr class="bg-slate-50 dark:bg-slate-700/50 sticky top-0 z-10">
                                    <th class="px-6 py-3 text-left text-xs font-bold uppercase">Nom Médicament</th>
                                    <th class="px-6 py-3 text-left text-xs font-bold uppercase">Forme & Dose</th>
                                    <th class="px-6 py-3 text-center text-xs font-bold uppercase">Créé le</th>
                                    <th class="px-6 py-3 text-center text-xs font-bold uppercase"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($medicaments as $medicament)
                                <tr class="hover:bg-slate-50 dark:hover:bg-slate-700/70 transition">
                                    <!-- Nom -->
                                    <td class="p-4 border-b dark:border-slate-600">
                                        <div class="flex items-center gap-3">
                                            <img src="{{ asset('assets/img/logo.png') }}" class="w-6 h-6" alt="logo" />
                                            <span class="text-sm font-semibold">{{ $medicament->nom }}</span>
                                        </div>
                                    </td>

                                    <!-- Forme + Dose -->
                                    <td class="p-4 border-b dark:border-slate-600">
                                        <p class="text-sm font-medium">{{ $medicament->forme->nom }}</p>
                                        <p class="text-xs text-slate-500 dark:text-slate-300">
                                            {{ $medicament->dose->quantite }} {{ $medicament->dose->unite }}
                                        </p>
                                    </td>

                                    <!-- Date -->
                                    <td class="p-4 text-center border-b dark:border-slate-600">
                                        <span class="text-xs text-slate-500 dark:text-slate-300">
                                            {{ $medicament->created_at }}
                                        </span>
                                    </td>

                                    <!-- Actions -->
                                    <td class="p-4 text-center border-b dark:border-slate-600">
                                        <button command="show-modal" commandfor="edit-medicament-{{ $medicament->id_medicament }}"
                                            class="flex items-center gap-1 px-3 py-1 text-xs font-semibold text-white bg-blue-500 rounded-lg hover:bg-blue-400">
                                            <img src="https://cdn-icons-png.flaticon.com/512/1828/1828911.png" class="w-3 h-3" alt="edit">
                                            Modifier
                                        </button>
                                        @include('medicaments.edit')
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
document.addEventListener("DOMContentLoaded", () => {
    const searchInput = document.getElementById('searchInput');
    const filterForme = document.getElementById('filterForme');
    const filterDose = document.getElementById('filterDose');
    const table = document.getElementById('medicamentTable');

    function normalize(str) {
        return str ? str.toString().normalize('NFD').replace(/[\u0300-\u036f]/g, '').toLowerCase().trim() : "";
    }

    function ensureNoResultsRow() {
        const tbody = table.querySelector('tbody');
        let noRow = tbody.querySelector('.no-results-row');
        if (!noRow) {
            const colCount = table.querySelectorAll('thead th').length;
            noRow = document.createElement('tr');
            noRow.className = 'no-results-row';
            noRow.innerHTML = `<td colspan="${colCount}" class="text-center italic py-4">Aucun résultat trouvé.</td>`;
            tbody.appendChild(noRow);
        }
        return noRow;
    }

    function filterTable() {
        const search = normalize(searchInput.value);
        const forme = normalize(filterForme.value);
        const dose = normalize(filterDose.value);

        const rows = table.querySelectorAll('tbody tr');
        let anyVisible = false;

        rows.forEach(row => {
            if (row.classList.contains('no-results-row')) return;

            const rowText = normalize(row.innerText);
            const matchSearch = !search || rowText.includes(search);
            const matchForme = !forme || rowText.includes(forme);
            const matchDose = !dose || rowText.includes(dose);

            if (matchSearch && matchForme && matchDose) {
                row.style.display = "";
                anyVisible = true;
            } else {
                row.style.display = "none";
            }
        });

        ensureNoResultsRow().style.display = anyVisible ? "none" : "";
    }

    searchInput.addEventListener("input", filterTable);
    filterForme.addEventListener("change", filterTable);
    filterDose.addEventListener("change", filterTable);

    filterTable();
});
</script>
@endsection
