@extends('layouts.main')
@section('content')
    <div class="w-full px-6 py-6 mx-auto">
        <div class="flex flex-wrap -mx-3">
            <div class="flex-none w-full max-w-full px-3">
                <div
                    class="relative flex flex-col mb-6 bg-white shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl">

                    <!-- Header -->
                    <div class="p-6 pb-0 mb-0 border-b rounded-t-2xl">
                        <h6 class="dark:text-white">Gestion des pharmacies</h6>
                        <button id="openModalBtn"
                            class="mt-4 px-4 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-500">
                            ➕ Ajouter une pharmacie
                        </button>
                    </div>

                    <!-- Modal -->
                    <div id="modal" class="fixed inset-0 z-50 hidden flex items-center justify-center">
                        <!-- Backdrop -->
                        <div id="backdrop" class="absolute inset-0 bg-black/40"></div>

                        <!-- Panel -->
                        <div class="relative z-60 w-full max-w-2xl mx-4 bg-white rounded-2xl shadow-lg">
                            <!-- Modal Header -->
                            <div class="flex items-center justify-between px-6 py-4 border-b">
                                <h2 class="text-lg font-medium">Ajouter une pharmacie</h2>
                                <button id="closeModalBtn" class="text-slate-500 hover:text-slate-700">✕</button>
                            </div>

                            <!-- Modal Body -->
                            <div class="px-6 py-6">
                                <form action="{{ route('pharmacies.store') }}" method="POST" class="space-y-4">
                                    @csrf

                                    <!-- Nom -->
                                    <div>
                                        <label for="nom" class="block text-sm font-medium text-slate-700">Nom de la
                                            pharmacie</label>
                                        <input type="text" name="nom" id="nom" required class="mt-1 block w-full px-3 py-2 border border-slate-300 rounded-lg shadow-sm
                                       focus:ring-emerald-500 focus:border-emerald-500 sm:text-sm">
                                    </div>

                                    <!-- Adresse -->
                                    <div>
                                        <label for="adresse"
                                            class="block text-sm font-medium text-slate-700">Adresse</label>
                                        <input type="text" name="adresse" id="adresse" required class="mt-1 block w-full px-3 py-2 border border-slate-300 rounded-lg shadow-sm
                                       focus:ring-emerald-500 focus:border-emerald-500 sm:text-sm">
                                    </div>

                                    <!-- Téléphone -->
                                    <div>
                                        <label for="telephone"
                                            class="block text-sm font-medium text-slate-700">Téléphone</label>
                                        <input type="text" name="telephone" id="telephone" required class="mt-1 block w-full px-3 py-2 border border-slate-300 rounded-lg shadow-sm
                                       focus:ring-emerald-500 focus:border-emerald-500 sm:text-sm">
                                    </div>

                                    <!-- Indice -->
                                    <div>
                                        <label for="indice" class="block text-sm font-medium text-slate-700">Indice</label>
                                        <input type="number" name="indice" id="indice" required class="mt-1 block w-full px-3 py-2 border border-slate-300 rounded-lg shadow-sm
                                       focus:ring-emerald-500 focus:border-emerald-500 sm:text-sm">
                                    </div>

                                    <!-- Gérants -->
                                    <div>
                                        <label for="id_gerant"
                                            class="block text-sm font-medium text-slate-700">Gérant</label>
                                        <select name="id_gerant" id="id_gerant" required class="mt-1 block w-full px-3 py-2 border border-slate-300 rounded-lg shadow-sm
                                       focus:ring-emerald-500 focus:border-emerald-500 sm:text-sm">
                                            @foreach($gerants as $gerant)
                                                <option value="{{ $gerant->id_gerant }}">
                                                    {{ $gerant->user->name }} ({{ $gerant->user->email }})
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <!-- Boutons -->
                                    <div class="flex justify-end space-x-3 pt-4">
                                        <button type="button" id="cancelModalBtn"
                                            class="px-4 py-2 bg-slate-300 text-slate-700 rounded-lg hover:bg-slate-400">
                                            Annuler
                                        </button>
                                        <button type="submit"
                                            class="px-4 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-500">
                                            Enregistrer
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>


                    <!-- Table -->
                    <div class="flex-auto px-0 pt-0 pb-2">
                        <div class="p-0 overflow-x-auto">
                            <table class="items-center w-full mb-0 border-collapse text-slate-500 dark:border-white/40">
                                <thead>
                                    <tr>
                                        <th
                                            class="px-6 py-3 text-left text-xxs font-bold uppercase text-slate-400 opacity-70 dark:text-white">
                                            Nom pharmacie</th>
                                        <th
                                            class="px-6 py-3 text-left text-xxs font-bold uppercase text-slate-400 opacity-70 dark:text-white">
                                            Adresse & Téléphone</th>
                                        <th
                                            class="px-6 py-3 text-center text-xxs font-bold uppercase text-slate-400 opacity-70 dark:text-white">
                                            Statut</th>
                                        <th
                                            class="px-6 py-3 text-center text-xxs font-bold uppercase text-slate-400 opacity-70 dark:text-white">
                                            Date création</th>
                                        <th class="px-6 py-3"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pharmacies as $pharmacie)
                                        <tr>
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
                                                    {{ $pharmacie->telephone }}
                                                </p>
                                            </td>
                                            <td class="p-2 text-center border-b dark:border-white/40">
                                                <span
                                                    class="px-2.5 py-1.4 text-xs font-bold uppercase text-white rounded bg-gradient-to-tl from-emerald-500 to-teal-400">
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

    <!-- Script -->
    <script>
        const modal = document.getElementById('modal');
        const openBtn = document.getElementById('openModalBtn');
        const closeBtn = document.getElementById('closeModalBtn');
        const cancelBtn = document.getElementById('cancelModalBtn');
        const backdrop = document.getElementById('backdrop');

        function openModal() {
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            document.body.style.overflow = 'hidden';
        }
        function closeModal() {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
            document.body.style.overflow = '';
        }

        openBtn.addEventListener('click', openModal);
        closeBtn.addEventListener('click', closeModal);
        cancelBtn.addEventListener('click', closeModal);
        backdrop.addEventListener('click', closeModal);
    </script>
@endsection
