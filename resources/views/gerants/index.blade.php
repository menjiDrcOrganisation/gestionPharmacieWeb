@extends('layouts.main')
@section('title', 'Gestion des gérants')

@section('content')


@if (session('success'))
    <div id="alert-message" class="mb-4 p-3 rounded-lg bg-green-100 text-green-800 shadow">
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div id="alert-message" class="mb-4 p-3 rounded-lg bg-red-100 text-red-800 shadow">
        {{ session('error') }}
    </div>
@endif

@if (session('info'))
    <div id="alert-message" class="mb-4 p-3 rounded-lg bg-blue-100 text-blue-800 shadow">
        {{ session('info') }}
    </div>
@endif


<div class="bg-white dark:bg-slate-900 w-full px-6 py-6 mx-auto">
    <div class="flex flex-wrap -mx-3">
        <div class="flex-none w-full max-w-full px-3">
            <div class="relative flex flex-col mb-6 bg-white dark:bg-slate-800 shadow-xl rounded-2xl">

                <!-- Header -->
                <div class="p-6 border-b rounded-t-2xl flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                    
                    <h6 class="dark:text-white text-xl font-semibold flex items-center gap-2 ">
                        {{-- <img src="https://cdn-icons-png.flaticon.com/512/2966/2966489.png" class="w-7 h-7" alt="icon"> --}}
                        Gestion des gérants</h6>

                    <div class="flex items-center gap-3">
                        <!-- Recherche -->
                        <div class="relative">
                        <input type="text" id="searchInput" placeholder="Rechercher (nom, email, pharmacie)..."
                            class="w-96 rounded-lg border border-slate-300 pl-9 pr-3 py-2 text-sm focus:ring-2 focus:ring-emerald-400 focus:outline-none dark:bg-slate-700 dark:text-white"
                        >
                        <span class="absolute left-2.5 top-2.5">
                            <img src="https://cdn-icons-png.flaticon.com/512/149/149852.png" class="w-4 h-4 opacity-70" alt="search">
                        </span>
                    </div>
                        <!-- Bouton Ajouter -->
                        <button command="show-modal" commandfor="add-gerant-dialog"
                        class="flex items-center gap-2 rounded-lg bg-blue-600 px-4 py-2 text-sm font-semibold text-white hover:bg-blue-500 shadow">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M12 4v16m8-8H4"/>
                        </svg>
                             Ajouter 
                        </button>
                    </div>
                </div>

                @include("gerants.create")

                <!-- Table -->
                <div class="flex-auto px-0 pt-4 pb-2">
                    <div class="overflow-x-auto">
                        <table id="gerantTable" class="min-w-full items-center mb-0 border-collapse text-slate-500 dark:border-white/40">
                            <thead class="bg-slate-100 dark:bg-slate-700">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-bold uppercase text-slate-600 dark:text-slate-200">Nom du gérant</th>
                                    <th class="px-6 py-3 text-left text-xs font-bold uppercase text-slate-600 dark:text-slate-200">Email</th>
                                    <th class="px-6 py-3 text-left text-xs font-bold uppercase text-slate-600 dark:text-slate-200">Pharmacies</th>
                                    <th class="px-6 py-3 text-center text-xs font-bold uppercase text-slate-600 dark:text-slate-200">Date création</th>
                                    <th class="px-6 py-3"></th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($gerants as $gerant)
                                    <tr class="hover:bg-slate-50 dark:hover:bg-slate-700">
                                        <!-- Nom du gérant -->
                                        <td class="p-4 align-middle border-b dark:border-slate-600">
                                            <h6 class="mb-0 text-sm dark:text-white">{{ ucfirst(strtolower($gerant->user->name ))}}</</h6>
                                        </td>

                                        <!-- Email -->
                                        <td class="p-4 align-middle border-b dark:border-slate-600">
                                            <p class="mb-0 text-xs text-slate-500 dark:text-slate-300">{{ ucfirst(strtolower($gerant->user->email ))}}</p>
                                        </td>

                                        <!-- Pharmacies : affiche 2 puis "Voir plus" -->
                                        <td class="p-4 align-middle border-b dark:border-slate-600">
                                            @if($gerant->pharmacies->isNotEmpty())
                                            <button onclick="document.getElementById('pharmacies-{{ $gerant->id_gerant }}').showModal()"
                                                class="px-3 py-1 text-xs bg-blue-100 text-blue-700 rounded hover:bg-blue-200 dark:bg-blue-700 dark:text-white">
                                                {{ $gerant->pharmacies->count() }} pharmacies
                                            </button>
                                        
                                            <!-- Modal : Pharmacies du Gérant -->
                                            <dialog id="pharmacies-{{ $gerant->id_gerant }}"
                                                    class="rounded-2xl shadow-2xl w-full max-w-lg p-0 bg-white dark:bg-slate-800 backdrop:bg-black/50 transition-all duration-300 ease-out">

                                                    <!-- Header -->
                                                    <div class="flex items-center justify-between px-6 py-4 border-b bg-gradient-to-r from-blue-600 to-blue-500 rounded-t-2xl">
                                                        <h3 class="text-lg font-semibold text-white flex items-center gap-2">
                                                            <img src="https://cdn-icons-png.flaticon.com/512/3063/3063828.png" class="w-5 h-5" alt="pharmacy">
                                                            Pharmacies de {{ ucfirst(strtolower($gerant->user->name ))}}
                                                        </h3>
                                                        <button type="button"
                                                            onclick="closePharmaciesModal('{{ $gerant->id_gerant }}')"
                                                            class="text-white hover:text-gray-200 transition">
                                                            ✕
                                                        </button>
                                                    </div>

                                                    <!-- Body -->
                                                    <div id="pharmacies-body-{{ $gerant->id_gerant }}" class="px-6 py-6">
                                                        <ul class="space-y-4">
                                                            @forelse($gerant->pharmacies as $pharmacie)
                                                                <li class="p-4 border border-slate-200 dark:border-slate-600 rounded-xl bg-slate-50 dark:bg-slate-700 shadow-sm hover:shadow-md transition">
                                                                    <p class="font-semibold text-slate-800 dark:text-white">{{ ucfirst(strtolower($pharmacie->nom ))}}</p>
                                                                    <p class="text-sm text-slate-600 dark:text-slate-300">{{ ucfirst(strtolower($pharmacie->adresse ))}}</p>
                                                                    <p class="text-sm text-slate-600 dark:text-slate-300">{{ ucfirst(strtolower($pharmacie->telephone ))}}</p>
                                                                </li>
                                                            @empty
                                                                <li class="text-center italic text-slate-500 dark:text-slate-300 py-6">
                                                                    Aucune pharmacie associée.
                                                                </li>
                                                            @endforelse
                                                        </ul>
                                                    </div>

                                                    <!-- Footer -->
                                                    <div class="flex justify-end px-6 py-4 border-t border-slate-200 dark:border-slate-700 rounded-b-2xl">
                                                        <button type="button"
                                                            onclick="closePharmaciesModal('{{ $gerant->id_gerant }}')"
                                                            class="px-4 py-2 text-sm font-medium bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 dark:bg-slate-600 dark:text-white dark:hover:bg-slate-500 transition">
                                                            Fermer
                                                        </button>
                                                    </div>
                                                </dialog>

                                                <!-- JS pour scroll dynamique et animations -->
                                                <script>
                                                function openPharmaciesModal(id) {
                                                    const dialog = document.getElementById(`pharmacies-${id}`);
                                                    const body = document.getElementById(`pharmacies-body-${id}`);
                                                    
                                                    // Activer scroll si plus de 3 pharmacies
                                                    const items = body.querySelectorAll('li');
                                                    if (items.length > 3) {
                                                        body.classList.add('max-h-[420px]', 'overflow-y-auto', 'custom-scroll');
                                                    } else {
                                                        body.classList.remove('max-h-[420px]', 'overflow-y-auto', 'custom-scroll');
                                                    }

                                                    // Ouvrir modal avec animation
                                                    if (dialog && typeof dialog.showModal === 'function') {
                                                        dialog.showModal();
                                                        setTimeout(() => {
                                                            dialog.classList.remove("scale-95", "opacity-0");
                                                            dialog.classList.add("scale-100", "opacity-100");
                                                        }, 10);
                                                    }
                                                }

                                                function closePharmaciesModal(id) {
                                                    const dialog = document.getElementById(`pharmacies-${id}`);
                                                    if (dialog) {
                                                        dialog.classList.add("scale-95", "opacity-0");
                                                        setTimeout(() => dialog.close(), 200);
                                                    }
                                                }
                                                </script>



                                            @else
                                                <div class="text-xs text-slate-400">Aucune pharmacie</div>
                                                <button command="show-modal" commandfor="dialog"
                                                    class=" flex mt-2 inline-block rounded-md bg-emerald-500 px-3 py-1 text-xs font-semibold text-white hover:bg-emerald-400">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                              d="M12 4v16m8-8H4"/>
                                                    </svg>
                                                    Ajouter
                                                </button>
                                            @endif
                                        </td>

                                        <!-- Date création -->
                                        <td class="p-4 text-center border-b dark:border-slate-600">
                                            <span class="text-xs text-slate-500 dark:text-slate-300">{{ $gerant->created_at->format('d/m/Y H:i') }}</span>
                                        </td>

                                        <!-- Actions -->
                                        <td class="p-4 align-middle border-b dark:border-slate-600">
                                            <button command="show-modal" commandfor="edit-gerant-{{ $gerant->id_gerant }}"
                                                class="inline-block flex items-center px-3 py-1 text-xs font-semibold text-white bg-blue-500 rounded hover:bg-blue-400">
                                                <img src="https://cdn-icons-png.flaticon.com/512/1828/1828911.png" class="w-3 h-3" alt="edit">
                                                 Modifier
                                            </button>

                                            @include('gerants.edit', ['gerant' => $gerant, 'pharmacies' => $pharmacies])
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

{{-- Scripts --}}
<script src="https://cdn.jsdelivr.net/npm/@tailwindplus/elements@1" type="module"></script>
<script>
document.addEventListener("DOMContentLoaded", () => {
    // --- Gestion des modals (data-attr pattern command / commandfor) ---
    document.querySelectorAll("[command='show-modal']").forEach(button => {
        button.addEventListener("click", () => {
            const targetId = button.getAttribute("commandfor");
            const dialog = document.getElementById(targetId);
            if (dialog && typeof dialog.showModal === 'function') dialog.showModal();
        });
    });

    // --- Recherche (filtre live sur le contenu texte de chaque row) ---
    const searchInput = document.getElementById('searchInput');
    searchInput.addEventListener('input', function () {
        const q = this.value.trim().toLowerCase();
        const rows = document.querySelectorAll('#gerantTable tbody tr');

        rows.forEach(row => {
            // on concatène les textes importants : nom, email, pharmacies, date
            const text = row.innerText.replace(/\s+/g, ' ').toLowerCase();
            row.style.display = text.includes(q) ? '' : 'none';
        });
    });

    // --- Voir plus / Voir moins pour pharmacies ---
    document.addEventListener('click', (e) => {
        const btn = e.target.closest('.see-more-btn');
        if (!btn) return;

        const targetId = btn.getAttribute('data-target');
        const target = document.getElementById(targetId);
        if (!target) return;

        const isHidden = target.classList.contains('hidden');
        if (isHidden) {
            // Montrer
            target.classList.remove('hidden');
            btn.textContent = 'Voir moins';
        } else {
            // Cacher
            target.classList.add('hidden');
            // remettre le texte par défaut (nombre d'éléments restants)
            // on récupère le nombre depuis l'attribut initial (nombre est dans le label précédent)
            // pour simplicité, recalculons le nombre visible : total - 2
            const total = target.querySelectorAll(':scope > div').length + 2;
            btn.textContent = `Voir plus (${total - 2})`;
        }
    });
});
</script>

  <script>
    document.addEventListener("DOMContentLoaded", () => {
        const alert = document.getElementById("alert-message");
        if (alert) {
            setTimeout(() => {
                alert.style.transition = "opacity 0.5s ease";
                alert.style.opacity = "0";
                setTimeout(() => alert.remove(), 500); // Supprime après animation
            }, 3000); // 3 secondes
        }
    });
</script>
@endsection
