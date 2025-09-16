@extends('layouts.main')
@section('content')
    <div class="w-full px-6 py-6 mx-auto">
        <!-- Gestion des formes -->
        <div class="flex flex-wrap -mx-3">
            <div class="flex-none w-full max-w-full px-3">
                <div
                    class="relative flex flex-col min-w-0 mb-6 break-words bg-blue-500 dark:bg-slate-800 shadow-xl rounded-2xl">

                    <!-- Header -->
                    <div
                        class="p-6 pb-0 mb-0 border-b-0 border-b-transparent rounded-t-2xl flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                        <h6 class="dark:text-white text-lg font-semibold">Gestion des Formes</h6>
                        <!-- Bouton Ajouter -->
                        <button command="show-modal" commandfor="dialog_forme"
                            class="rounded-md bg-white/10 px-4 py-2 text-sm font-semibold text-blue-800 ring-1 ring-inset ring-white/5 hover:bg-white/20">
                            ➕ Ajouter une Forme
                        </button>

                        <!-- Recherche -->
                        <input type="text" id="searchInputForme" placeholder="Rechercher..."
                            class="rounded-md border border-slate-300 px-3 py-2 focus:ring-2 focus:ring-emerald-300 focus:outline-none">
                    </div>

                    @include('formes.create')

                    <!-- Table scrollable -->
                    <div class="flex-auto px-0 pt-4 pb-2 max-h-[400px] overflow-y-auto overflow-x-auto">
                        <table id="formeTable"
                            class="min-w-full items-center mb-0 align-top border-collapse dark:border-white/40 text-slate-500">
                            <thead class="align-bottom bg-slate-50 dark:bg-slate-800 sticky top-0 z-10">
                                <tr>
                                    <th
                                        class="px-6 py-3 font-bold text-left uppercase text-xxs text-slate-400 dark:text-white tracking-none whitespace-nowrap">
                                        Nom Forme
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
                                @foreach ($formes as $forme)
                                    <tr class="hover:bg-slate-100 dark:hover:bg-slate-700">
                                        <td class="p-2 align-middle whitespace-nowrap">
                                            <div class="flex items-center px-2 py-1">
                                                <span class="text-sm dark:text-white">{{ $forme->nom }}</span>
                                            </div>
                                        </td>
                                        <td class="p-2 text-center align-middle whitespace-nowrap">
                                            <span
                                                class="text-xs text-slate-400 dark:text-white dark:opacity-80">{{ $forme->created_at }}</span>
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
        // Filtre recherche simple
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