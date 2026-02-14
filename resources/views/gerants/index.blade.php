@extends('layouts.main')
@section('content')
    <div class="bg-blue-500 dark:bg-slate-900 w-full px-6 py-6 mx-auto">
        <div class="flex flex-wrap -mx-3">
            <div class="flex-none w-full max-w-full px-3">
                <div class="relative flex flex-col mb-6 bg-blue-500 dark:bg-slate-800 shadow-xl rounded-2xl">

                    <!-- Header -->
                    <div
                        class="p-6 pb-0 mb-0 border-b rounded-t-2xl flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                        <h6 class="dark:text-white text-lg font-semibold">Gestion des gérants</h6>

                        <!-- Bouton Ajouter -->
                        <button command="show-modal" commandfor="add-gerant-dialog"
                            class="rounded-md bg-white/10 px-4 py-2 text-sm font-semibold text-blue-800 ring-1 ring-inset ring-white/5 hover:bg-white/20">
                            ➕ Ajouter un gérant
                        </button>

                        <!-- Input recherche -->
                        <input type="text" id="searchInput" placeholder="Rechercher..."
                            class="rounded-md border border-slate-300 px-3 py-2 focus:ring-2 focus:ring-emerald-300 focus:outline-none">
                    </div>

                    @include("gerants.create")

                    <!-- Table -->
                    <div class="flex-auto px-0 pt-4 pb-2">
                        <div class="overflow-x-auto">
                            <table id="gerantTable"
                                class="min-w-full items-center mb-0 border-collapse text-slate-500 dark:border-white/40">
                                <thead>
                                    <tr>
                                        <th
                                            class="px-6 py-3 text-left text-xxs font-bold uppercase text-slate-400 dark:text-white">
                                            Nom du gérant</th>
                                        <th
                                            class="px-6 py-3 text-left text-xxs font-bold uppercase text-slate-400 dark:text-white">
                                            Email</th>
                                        <th
                                            class="px-6 py-3 text-left text-xxs font-bold uppercase text-slate-400 dark:text-white">
                                            Pharmacies</th>
                                        <th
                                            class="px-6 py-3 text-center text-xxs font-bold uppercase text-slate-400 dark:text-white">
                                            Date création</th>
                                        <th class="px-6 py-3"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($gerants as $gerant)
                                        <tr class="hover:bg-slate-100 dark:hover:bg-slate-700">
                                            <!-- Nom du gérant -->
                                            <td class="p-2 align-middle border-b dark:border-white/40">
                                                <h6 class="mb-0 text-sm dark:text-white">{{ $gerant->user->name }}</h6>
                                            </td>

                                            <!-- Email -->
                                            <td class="p-2 align-middle border-b dark:border-white/40">
                                                <p class="mb-0 text-xs text-slate-400 dark:text-white dark:opacity-80">
                                                    {{ $gerant->user->email }}
                                                </p>
                                            </td>

                                            <!-- Pharmacies du gérant -->
                                            <td class="p-2 align-middle border-b dark:border-white/40">
                                                @if($gerant->pharmacies->isNotEmpty())
                                                    <ul class="list-disc list-inside text-xs dark:text-white space-y-1">
                                                        @foreach ($gerant->pharmacies as $pharmacie)
                                                            <li>
                                                                {{ $pharmacie->nom }}
                                                                <span class="text-slate-400">({{ $pharmacie->adresse }},
                                                                    {{ $pharmacie->telephone }})</span>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                @else

                                                    <span class="text-xs text-slate-400">Aucune pharmacie</span>
                                                    <!-- Bouton Ajouter -->
                                                    <button command="show-modal" commandfor="dialog"
                                                        class="rounded-md bg-white/10 px-4 py-2 text-sm font-semibold text-blue-800 ring-1 ring-inset ring-white/5 hover:bg-white/20">
                                                        Ajouter une pharmacie
                                                    </button>
                                                @endif
                                            </td>

                                            <!-- Date création -->
                                            <td class="p-2 text-center border-b dark:border-white/40">
                                                <span class="text-xs text-slate-400 dark:text-white dark:opacity-80">
                                                    {{ $gerant->created_at }}
                                                </span>
                                            </td>

                                            <!-- Actions -->
                                            <td class="p-2 align-middle border-b dark:border-white/40">
                                                <button command="show-modal" commandfor="edit-gerant-{{ $gerant->id_gerant }}"
                                                    class="inline-block px-3 py-1 text-xs font-semibold text-white bg-blue-500 rounded hover:bg-blue-400">
                                                    Edit
                                                </button>

                                                @include('gerants.edit', ['gerant' => $gerant, 'pharmacies' => $pharmacies])
                                            </td>

                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @include('pharmacies.create')
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@tailwindplus/elements@1" type="module"></script>
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            document.querySelectorAll("[command='show-modal']").forEach(button => {
                button.addEventListener("click", () => {
                    const targetId = button.getAttribute("commandfor");
                    const dialog = document.getElementById(targetId);
                    if (dialog) dialog.showModal();
                });
            });
        });
    </script>

    <!-- Recherche -->
    <script>
        document.getElementById('searchInput').addEventListener('keyup', function () {
            const filter = this.value.toLowerCase();
            const rows = document.querySelectorAll('#gerantTable tbody tr');
            rows.forEach(row => {
                const text = row.textContent.toLowerCase();
                row.style.display = text.includes(filter) ? '' : 'none';
            });
        });
    </script>
@endsection
