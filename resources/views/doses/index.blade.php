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
                                                <a href="{{ route('doses.edit', $dose->id) }}"
                                                    class="inline-block px-3 py-1 text-xs font-semibold text-white bg-blue-500 rounded hover:bg-blue-400">
                                                    Edit
                                                </a>
                                                <form action="{{ route('doses.destroy', $dose->id) }}" method="POST"
                                                    class="inline-block">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="inline-block px-3 py-1 text-xs font-semibold text-white bg-red-500 rounded hover:bg-red-400">
                                                        Supprimer
                                                    </button>
                                                </form>
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
@endsection