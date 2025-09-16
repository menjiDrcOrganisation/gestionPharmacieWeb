@extends('layouts.main')
@section('content')
    <div class="bg-blue-500 dark:bg-slate-900 w-full px-6 py-6 mx-auto">
        <div class="flex flex-wrap -mx-3">
            <div class="flex-none w-full max-w-full px-3">
                <div class="relative flex flex-col mb-6 bg-blue-500 dark:bg-slate-800 shadow-xl rounded-2xl">

                    <!-- Header -->
                    <div
                        class="p-6 pb-0 mb-0 border-b rounded-t-2xl flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                        <h6 class="dark:text-white text-lg font-semibold">Gestion des pharmacies</h6>

                        <div class="flex gap-2 items-center">
                            <!-- Bouton Ajouter -->
                            <button command="show-modal" commandfor="dialog"
                                class="rounded-md bg-white/10 px-4 py-2 text-sm font-semibold text-blue-800 ring-1 ring-inset ring-white/5 hover:bg-white/20">
                                ➕ Ajouter une pharmacie
                            </button>

                            <!-- Input recherche -->
                            <input type="text" id="searchInput" placeholder="Rechercher..."
                                class="rounded-md border border-slate-300 px-3 py-2 focus:ring-2 focus:ring-emerald-300 focus:outline-none">
                        </div>
                    </div>

                    @include("pharmacies.create")

                    <!-- Table -->
                    <div class="flex-auto px-0 pt-4 pb-2">
                        <div class="overflow-x-auto">
                            <table id="pharmacyTable"
                                class="min-w-full items-center mb-0 border-collapse text-slate-500 dark:border-white/40">
                                <thead>
                                    <tr>
                                        <th
                                            class="px-6 py-3 text-left text-xxs font-bold uppercase text-slate-400 dark:text-white">
                                            Nom pharmacie</th>
                                        <th
                                            class="px-6 py-3 text-left text-xxs font-bold uppercase text-slate-400 dark:text-white">
                                            Adresse & Téléphone</th>
                                        <th
                                            class="px-6 py-3 text-center text-xxs font-bold uppercase text-slate-400 dark:text-white">
                                            Statut</th>
                                        <th
                                            class="px-6 py-3 text-center text-xxs font-bold uppercase text-slate-400 dark:text-white">
                                            Date création</th>
                                        <th class="px-6 py-3"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pharmacies as $pharmacie)
                                        <tr class="hover:bg-slate-100 dark:hover:bg-slate-700">
                                            <td class="p-2 align-middle border-b dark:border-white/40">
                                                <h6 class="mb-0 text-sm dark:text-white">{{ $pharmacie->nom }}</h6>
                                                <p class="mb-0 text-xs text-slate-400 dark:text-white dark:opacity-80">
                                                    Créé par : {{ $pharmacie->gerant->user->name }}
                                                    ({{ $pharmacie->gerant->user->email }})
                                                </p>
                                            </td>
                                            <td class="p-2 align-middle border-b dark:border-white/40">
                                                <p class="mb-0 text-xs font-semibold dark:text-white">{{ $pharmacie->adresse }}
                                                </p>
                                                <p class="mb-0 text-xs text-slate-400 dark:text-white dark:opacity-80">
                                                    {{ $pharmacie->telephone }}</p>
                                            </td>
                                            <td class="p-2 text-center border-b dark:border-white/40">
                                                <span
                                                    class="px-2.5 py-1.5 text-xs font-bold uppercase text-white rounded bg-gradient-to-tl from-emerald-500 to-teal-400">
                                                    {{ $pharmacie->statut }}
                                                </span>
                                            </td>
                                            <td class="p-2 text-center border-b dark:border-white/40">
                                                <span
                                                    class="text-xs text-slate-400 dark:text-white dark:opacity-80">{{ $pharmacie->created_at }}</span>
                                            </td>
                                            <td class="p-2 align-middle border-b dark:border-white/40">
                                                <a href="#"
                                                    class="text-xs text-slate-400 dark:text-white dark:opacity-80 font-semibold">Edit</a>
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

    <script src="https://cdn.jsdelivr.net/npm/@tailwindplus/elements@1" type="module"></script>

    <!-- Script recherche simple -->
    <script>
        document.getElementById('searchInput').addEventListener('keyup', function () {
            const filter = this.value.toLowerCase();
            const rows = document.querySelectorAll('#pharmacyTable tbody tr');

            rows.forEach(row => {
                const text = row.textContent.toLowerCase();
                row.style.display = text.includes(filter) ? '' : 'none';
            });
        });
    </script>
@endsection