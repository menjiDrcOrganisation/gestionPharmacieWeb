@extends('layouts.main')
@section('title','Administrateurs')

@section('content')
<div class="bg-white dark:bg-slate-900 w-full px-6 py-6 mx-auto">
    <div class="flex flex-wrap -mx-3">
        <div class="flex-none w-full max-w-full px-3">
            <div class="relative flex flex-col mb-6 bg-white dark:bg-slate-800 shadow-xl rounded-2xl">

                <!-- Header -->
                <div class="p-6 border-b rounded-t-2xl flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                    <h6 class="dark:text-white text-xl font-semibold flex items-center gap-2">
                        {{-- <img src="https://cdn-icons-png.flaticon.com/512/2966/2966489.png" class="w-7 h-7" alt="icon">  --}}
                        Gestion des administrateurs
                    </h6>

                    <div class="flex flex-wrap items-center gap-3">
                        <!-- Recherche -->
                        <div class="relative">
                            <input type="text" id="searchInput" placeholder="Rechercher..."
                                class="w-96 rounded-lg border border-slate-300 pl-9 pr-3 py-2 text-sm focus:ring-2 focus:ring-emerald-400 focus:outline-none dark:bg-slate-700 dark:text-white">
                            <span class="absolute left-2.5 top-2.5">
                                <img src="https://cdn-icons-png.flaticon.com/512/149/149852.png" class="w-4 h-4 opacity-70" alt="search">
                            </span>
                        </div>

                        <!-- Bouton Ajouter -->
                        <button command="show-modal" commandfor="add-admin-dialogg"
                            class="flex items-center gap-2 rounded-lg bg-blue-600 px-4 py-2 text-sm font-semibold text-white hover:bg-blue-500 shadow">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M12 4v16m8-8H4"/>
                            </svg>
                            Ajouter
                        </button>
                    </div>
                </div>

                @include('admins.create')

                <!-- Table -->
                <div class="flex-auto px-0 pt-4 pb-2">
                    <div class="overflow-x-auto max-h-[500px] overflow-y-auto">
                        <table id="adminTable"
                            class="min-w-full border-collapse text-slate-600 dark:text-slate-200">
                            <thead>
                                <tr class="bg-slate-50 dark:bg-slate-700/50 sticky top-0 z-10">
                                    <th class="px-6 py-3 text-left text-xs font-bold uppercase">Nom</th>
                                    <th class="px-6 py-3 text-left text-xs font-bold uppercase">Email</th>
                                    <th class="px-6 py-3 text-center text-xs font-bold uppercase">Date création</th>
                                    <th class="px-6 py-3 text-center text-xs font-bold uppercase"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($admins as $aadmin)
                                <tr class="hover:bg-slate-50 dark:hover:bg-slate-700/70 transition">
                                    <!-- Nom -->
                                    <td class="p-4 border-b dark:border-slate-600">
                                        <span class="text-sm font-light">{{ ucfirst(strtolower($aadmin->user->name ?? ' ' ))}}</</span>
                                    </td>

                                    <!-- Email -->
                                    <td class="p-4 border-b dark:border-slate-600">
                                        <p class="text-sm font-light">{{ ucfirst(strtolower($aadmin->user->email ?? ' ' ))}}</p>
                                    </td>

                                    <!-- Date création -->
                                    <td class="p-4 text-center border-b dark:border-slate-600">
                                        <span class="text-xs text-slate-500 dark:text-slate-300">
                                            {{ $aadmin->created_at?->format('d/m/Y') ?? 'N/A' }}
                                        </span>
                                    </td>

                                    <!-- Actions -->
                                    <td class="p-4 text-center border-b dark:border-slate-600">
                                        <button command="show-modal" commandfor="edit-admin-{{ $aadmin->id_admin }}"
                                            class="flex items-center gap-1 px-3 py-1 text-xs font-semibold text-white bg-blue-500 rounded-lg hover:bg-blue-400">
                                            <img src="https://cdn-icons-png.flaticon.com/512/1828/1828911.png" class="w-3 h-3" alt="edit">
                                            Modifier
                                        </button>
                                        @include('admins.edit')
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
    const table = document.getElementById('adminTable');

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
        const rows = table.querySelectorAll('tbody tr');
        let anyVisible = false;

        rows.forEach(row => {
            if (row.classList.contains('no-results-row')) return;
            const rowText = normalize(row.innerText);
            if (!search || rowText.includes(search)) {
                row.style.display = "";
                anyVisible = true;
            } else {
                row.style.display = "none";
            }
        });

        ensureNoResultsRow().style.display = anyVisible ? "none" : "";
    }

    searchInput.addEventListener("input", filterTable);
    filterTable();
});
</script>
@endsection
