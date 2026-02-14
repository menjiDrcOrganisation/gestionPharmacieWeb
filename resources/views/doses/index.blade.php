@extends('layouts.main')
@section('content')
    <div class="w-full px-6 py-6 mx-auto">

        <!-- Card Doses -->
        <div class="flex flex-wrap -mx-3">
            <div class="flex-none w-full max-w-full px-3">
                <div
                    class="relative flex flex-col min-w-0 mb-6 break-words bg-blue-500 dark:bg-slate-800  dark:bg-slate-850 shadow-xl dark:shadow-dark-xl rounded-2xl">

                    <!-- Header -->
                    <div class="p-6 pb-0 mb-0 border-b border-transparent rounded-t-2xl flex justify-between items-center">
                        <h6 class="dark:text-white font-semibold text-lg">Gestion des Doses</h6>
                        <!-- Bouton Ajouter -->
                        <button onclick="document.getElementById('modal-create').classList.remove('hidden')"
                            class="rounded-md bg-white/10 px-4 py-2 text-sm font-semibold text-blue-800 ring-1 ring-inset ring-white/5 hover:bg-white/20">
                            ➕ Ajouter une dose
                        </button>
                    </div>

                    <!-- Barre de recherche -->
                    <div class="p-6 pt-4">
                        <form method="GET" action="{{ route('doses.index') }}">
                            <input type="text" name="search" placeholder="Rechercher une dose..."
                                value="{{ request('search') }}"
                                class="w-full md:w-1/3 rounded-md border border-slate-300 py-2 px-3 focus:ring-2 focus:ring-blue-400 focus:border-transparent dark:bg-slate-700 dark:text-white">
                        </form>
                    </div>

                    <!-- Table -->
                    <div class="flex-auto px-0 pt-2 pb-4">
                        <div class="p-0 overflow-x-auto">
                            <table class="items-center w-full mb-0 align-top border-collapse text-slate-500">
                                <thead>
                                    <tr>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-bold text-slate-400 uppercase tracking-wider">
                                            Quantité
                                        </th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-bold text-slate-400 uppercase tracking-wider">
                                            Unité
                                        </th>
                                        <th
                                            class="px-6 py-3 text-center text-xs font-bold text-slate-400 uppercase tracking-wider">
                                            Date de création
                                        </th>
                                        <th
                                            class="px-6 py-3 text-center text-xs font-bold text-slate-400 uppercase tracking-wider">
                                            Actions
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($doses as $dose)
                                        <tr class="hover:bg-slate-100 dark:hover:bg-slate-700">
                                            <td class="px-6 py-3 text-sm text-slate-700 dark:text-white">{{ $dose->quantite }}
                                            </td>
                                            <td class="px-6 py-3 text-sm text-slate-700 dark:text-white">{{ $dose->unite }}</td>
                                            <td class="px-6 py-3 text-center text-sm text-slate-500 dark:text-slate-300">
                                                {{ $dose->created_at }}
                                            </td>
                                            <td class="px-6 py-3 text-center text-sm">

                                                <!-- Bouton Edit -->
                                                <button command="show-modal" commandfor="edit-dose-{{ $dose->id }}"
                                                    class="inline-block px-3 py-1 text-xs font-semibold text-white bg-blue-500 rounded hover:bg-blue-400">
                                                    ✏️ Edit
                                                </button>
                                                @include('doses.edit')

                                                <!-- Bouton Supprimer -->
                                                <!-- <button type="button"
                                                    onclick="document.getElementById('delete-dose-{{ $dose->id }}').showModal()"
                                                    class="inline-block px-3 py-1 text-xs font-semibold text-white bg-red-500 rounded hover:bg-red-400">
                                                    Supprimer
                                                </button> -->

                                                <!-- Modal Delete -->
                                                <dialog id="delete-dose-{{ $dose->id }}"
                                                    class="p-6 bg-white dark:bg-slate-800 rounded-2xl shadow-xl w-full max-w-md">

                                                    <!-- Header -->
                                                    <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100 mb-4">
                                                        Confirmation
                                                    </h3>

                                                    <!-- Message -->
                                                    <p class="text-sm text-gray-600 dark:text-gray-300 mb-6">
                                                        Es-tu sûr de vouloir supprimer cette dose ?<br>
                                                        Cette action est irréversible.
                                                    </p>

                                                    <!-- Actions -->
                                                    <div class="flex justify-end gap-3">
                                                        <!-- Bouton Annuler -->
                                                        <button type="button"
                                                            onclick="document.getElementById('delete-dose-{{ $dose->id }}').close()"
                                                            class="px-4 py-2 text-sm bg-gray-200 dark:bg-slate-700 text-gray-800 dark:text-gray-200 rounded hover:bg-gray-300 dark:hover:bg-slate-600">
                                                            Annuler
                                                        </button>

                                                        <!-- Bouton Confirmer -->
                                                        <form action="{{ route('doses.destroy', $dose->id_dose) }}" method="POST"
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
                                    @endforeach
                                    @if($doses->isEmpty())
                                        <tr>
                                            <td colspan="4"
                                                class="px-6 py-3 text-center text-sm text-slate-400 dark:text-slate-300">
                                                Aucune dose enregistrée.
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        @include('doses.create')


    </div>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindplus/elements@1" type="module"></script>
@endsection
