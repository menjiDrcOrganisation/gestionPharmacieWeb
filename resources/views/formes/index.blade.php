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
<<<<<<< HEAD
                                <tr class="hover:bg-slate-50 dark:hover:bg-slate-700/70 transition">
                                    <td class="p-3 sm:p-4 border-b dark:border-slate-600">
                                        <div class="flex items-center gap-2 sm:gap-3">
                                            {{-- <img src="{{ asset('assets/img/logo.png') }}" class="w-5 h-5 sm:w-6 sm:h-6" alt="logo" /> --}}
                                            <span class="text-sm sm:text-base font-light">{{ ucfirst(strtolower($forme->nom))}}</span>
                                        </div>
                                    </td>
                                    <td class="p-3 sm:p-4 text-center border-b dark:border-slate-600">
                                        <span class="text-xs sm:text-sm font-light text-slate-500 dark:text-slate-300">{{ $forme->created_at->format('d/m/Y') ?? ' ' }}</span>
                                    </td>
                                    <td class="p-3 sm:p-4 text-center border-b dark:border-slate-600 flex justify-center gap-2 sm:gap-3 flex-col sm:flex-row">
                                        <button command="show-modal" commandfor="edit-forme-{{ $forme->id_forme }}"
                                                class="flex items-center gap-1 px-3 py-1 text-xs sm:text-sm font-semibold text-white bg-blue-500 rounded-lg hover:bg-blue-400">
                                            <img src="https://cdn-icons-png.flaticon.com/512/1828/1828911.png" class="w-3 h-3" alt="edit">
                                            {{-- Modifier --}}
                                        </button>
                                        @include('formes.edit')
                                    </td>
                                </tr>
=======
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
                                            <!-- Bouton Edit -->
                                            <button command="show-modal" commandfor="edit-forme-{{ $forme->id_forme }}"
                                                class="inline-block px-3 py-1 text-xs font-semibold text-white bg-blue-500 rounded hover:bg-blue-400">
                                                ✏️ Edit
                                            </button>
                                            @include('formes.edit')

                                            <!-- Bouton Supprimer -->
                                            <!-- <button type="button"
                                                onclick="document.getElementById('delete-forme-{{ $forme->id_forme }}').showModal()"
                                                class="inline-block px-3 py-1 text-xs font-semibold text-white bg-red-500 rounded hover:bg-red-400">
                                                Supprimer
                                            </button> -->

                                            <!-- Modal Delete -->
                                            <dialog id="delete-forme-{{ $forme->id_forme}}"
                                                class="p-6 bg-white dark:bg-slate-800 rounded-2xl shadow-xl w-full max-w-md">

                                                <!-- Header -->
                                                <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100 mb-4">
                                                    Confirmation
                                                </h3>

                                                <!-- Message -->
                                                <p class="text-sm text-gray-600 dark:text-gray-300 mb-6">
                                                    Es-tu sûr de vouloir supprimer cette forme ?<br>
                                                    Cette action est irréversible.
                                                </p>

                                                <!-- Actions -->
                                                <div class="flex justify-end gap-3">
                                                    <!-- Bouton Annuler -->
                                                    <button type="button"
                                                        onclick="document.getElementById('delete-forme-{{ $forme->id_forme }}').close()"
                                                        class="px-4 py-2 text-sm bg-gray-200 dark:bg-slate-700 text-gray-800 dark:text-gray-200 rounded hover:bg-gray-300 dark:hover:bg-slate-600">
                                                        Annuler
                                                    </button>

                                                    <!-- Bouton Confirmer -->
                                                    <form action="{{ route('formes.destroy', $forme->id_forme) }}" method="POST"
                                                        class="inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="px-4 py-2 text-sm font-semibold text-white bg-red-600 rounded hover:bg-red-500">
                                                            Confirmer
                                                        </button>
                                                    </form>
                                                </div>
                                            </dialog>


                                        </td>
                                    </tr>
>>>>>>> testweb
                                @endforeach
                            </tbody>
                        </table>
                    </div>
<<<<<<< HEAD
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
=======

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
>>>>>>> testweb
