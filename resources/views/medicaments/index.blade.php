@extends('layouts.main')
@section('content')
    <div class="w-full px-6 py-6 mx-auto">
        <!-- Gestion des médicaments -->
        <div class="flex flex-wrap -mx-3">
            <div class="flex-none w-full max-w-full px-3">
                <div
                    class="relative flex flex-col min-w-0 mb-6 break-words dark:bg-slate-800 bg-blue-500 dark:bg-slate-850 shadow-xl rounded-2xl">

                    <!-- Header -->
                    <div
                        class="p-6 pb-0 mb-0 border-b-0 border-b-transparent rounded-t-2xl flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                        <h6 class="dark:text-white text-lg font-semibold">Gestion des médicaments</h6>

                        <!-- Filtres -->
                        <div class="flex flex-wrap gap-2">
                            <!-- Recherche globale -->
                            <input type="text" id="searchInput" placeholder="Rechercher..."
                                class="rounded-md border border-slate-300 px-3 py-2 focus:ring-2 focus:ring-emerald-300 focus:outline-none">

                            <!-- Filtre par forme -->
                            <select id="filterForme"
                                class="rounded-md border border-slate-300 px-3 py-2 focus:ring-2 focus:ring-emerald-300 focus:outline-none">
                                <option value="">Toutes les formes</option>
                                @foreach($formes as $forme)
                                    <option value="{{ strtolower($forme->nom) }}">{{ $forme->nom }}</option>
                                @endforeach
                            </select>

                            <!-- Filtre par dose -->
                            <select id="filterDose"
                                class="rounded-md border border-slate-300 px-3 py-2 focus:ring-2 focus:ring-emerald-300 focus:outline-none">
                                <option value="">Toutes les doses</option>
                                @foreach($doses as $dose)
                                    <option value="{{ strtolower($dose->quantite . ' ' . $dose->unite) }}">
                                        {{ $dose->quantite }} {{ $dose->unite }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Bouton Ajouter -->
                        <button command="show-modal" commandfor="dialog_medoc"
                            class="rounded-md bg-white/10 px-4 py-2 text-sm font-semibold text-blue-800 ring-1 ring-inset ring-white/5 hover:bg-white/20">
                            ➕ Ajouter un Medicament
                        </button>
                    </div>

                    @include('medicaments.create')

                    <!-- Table scrollable -->
                    <div class="flex-auto px-0 pt-4 pb-2 max-h-[500px] overflow-y-auto overflow-x-auto">
                        <table id="medicamentTable"
                            class="min-w-full items-center mb-0 align-top border-collapse dark:border-white/40 text-slate-500">
                            <thead class="align-bottom bg-slate-50 dark:bg-slate-800 sticky top-0 z-10">
                                <tr>
                                    <th
                                        class="px-6 py-3 font-bold text-left uppercase text-xxs text-slate-400 dark:text-white tracking-none whitespace-nowrap">
                                        Noms Medicaments
                                    </th>
                                    <th
                                        class="px-6 py-3 font-bold text-left uppercase text-xxs text-slate-400 dark:text-white tracking-none whitespace-nowrap">
                                        Forme & Dose
                                    </th>
                                    <th
                                        class="px-6 py-3 font-bold text-center uppercase text-xxs text-slate-400 dark:text-white tracking-none whitespace-nowrap">
                                        Date de création
                                    </th>
                                    <th
                                        class="px-6 py-3 font-bold text-center uppercase text-xxs text-slate-400 dark:text-white tracking-none whitespace-nowrap">
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($medicaments as $medicament)
                                    <tr class="hover:bg-slate-100 dark:hover:bg-slate-700">
                                        <td class="p-2 align-middle whitespace-nowrap">
                                            <div class="flex items-center px-2 py-1">
                                                <img src="../assets/img/small-logos/logo-invision.svg"
                                                    class="inline-flex items-center justify-center mr-2 rounded-full h-9 w-9"
                                                    alt="logo" />
                                                <span class="text-sm dark:text-white">{{ $medicament->nom }}</span>
                                            </div>
                                        </td>
                                        <td class="p-2 align-middle whitespace-nowrap">
                                            <p class="text-xs font-semibold dark:text-white">{{ $medicament->forme->nom }}</p>
                                            <p class="text-xs text-slate-400 dark:text-white dark:opacity-80">
                                                {{ $medicament->dose->quantite }} {{ $medicament->dose->unite }}
                                            </p>
                                        </td>
                                        <td class="p-2 text-center align-middle whitespace-nowrap">
                                            <span
                                                class="text-xs text-slate-400 dark:text-white dark:opacity-80">{{ $medicament->created_at }}</span>
                                        </td>
                                        <td class="p-2 text-center align-middle whitespace-nowrap">
                                            <a href="javascript:;"
                                                class="text-xs font-semibold text-slate-400 dark:text-white dark:opacity-80">Edit</a>
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

    <script src="https://cdn.jsdelivr.net/npm/@tailwindplus/elements@1" type="module"></script>

    <script>
        function filterTable() {
            const searchValue = document.getElementById('searchInput').value.toLowerCase();
            const formeValue = document.getElementById('filterForme').value.toLowerCase();
            const doseValue = document.getElementById('filterDose').value.toLowerCase();
            const rows = document.querySelectorAll('#medicamentTable tbody tr');

            rows.forEach(row => {
                const nom = row.cells[0].textContent.toLowerCase();
                const forme = row.cells[1].children[0].textContent.toLowerCase();
                const dose = row.cells[1].children[1].textContent.toLowerCase();

                const matchesSearch = nom.includes(searchValue);
                const matchesForme = forme.includes(formeValue) || formeValue === '';
                const matchesDose = dose.includes(doseValue) || doseValue === '';

                row.style.display = (matchesSearch && matchesForme && matchesDose) ? '' : 'none';
            });
        }

        // Écouteurs sur les champs
        document.getElementById('searchInput').addEventListener('keyup', filterTable);
        document.getElementById('filterForme').addEventListener('change', filterTable);
        document.getElementById('filterDose').addEventListener('change', filterTable);
    </script>
@endsection