@extends('layouts.main')
@section('title','Tableau de bord')
@section('content')
    <div class="px-6 py-6 w-full bg-gray-100 dark:bg-slate-900">

        <!-- ===== Stat Cards ===== -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">

            <!-- Gérants -->
            <div class="bg-white dark:bg-slate-800 p-4 rounded-2xl animate-fadeInScale">
                <div class="flex items-center justify-center w-10 h-10 rounded-lg bg-green-200 text-dark mb-3">
                    <!-- Icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M17 20h5v-2a4 4 0 00-3-3.87M9 20h6M3 20h5v-2a4 4 0 00-3-3.87M12 12a4 4 0 100-8 4 4 0 000 8z"/>
                    </svg>
                </div>
                <h3 class="text-sm font-roboto font-bold text-slate-500 dark:text-white">Gérants</h3>
                <p class="text-2xl font-roboto font-bold dark:text-white">{{ $totalAdmins }}</p>
                <p class="text-xs font-roboto text-slate-500 mt-2">
                    Last 30 days
                    <span class="px-2 py-1 rounded-full text-xs font-semibold {{ $adminsVariation >= 0 ? 'bg-green-100 text-green-600' : 'bg-red-100 text-red-600' }}">
                        {{ number_format($adminsVariation, 2) }}%
                    </span>
                </p>
            </div>
        
            <!-- Pharmacies -->
            <div class="bg-white dark:bg-slate-800 p-4 rounded-2xl  animate-fadeInScale">
                <div class="flex items-center justify-center w-10 h-10 rounded-lg bg-green-200 text-dark mb-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M3 21h18M9 8h6m-6 4h6m-6 4h6m6 5V3a1 1 0 00-1-1H4a1 1 0 00-1 1v18"/>
                    </svg>
                </div>
                <h3 class="text-sm font-roboto font-bold text-slate-500 dark:text-white">Pharmacies</h3>
                <p class="text-2xl font-bold dark:text-white">{{ $totalPharmacies }}</p>
                <p class="text-xs font-roboto text-slate-500 mt-2">
                    Last 30 days
                    <span class="px-2 py-1 rounded-full text-xs font-semibold {{ $pharmaciesVariation >= 0 ? 'bg-green-100 text-green-600' : 'bg-red-100 text-red-600' }}">
                        {{ number_format($pharmaciesVariation, 2) }}%
                    </span>
                </p>
            </div>
        
            <!-- Nouveaux Pharmacies -->
            <div class="bg-white dark:bg-slate-800 p-4 rounded-2xl animate-fadeInScale">
                <div class="flex items-center justify-center w-10 h-10 rounded-lg bg-green-200 text-dark mb-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M12 4v16m8-8H4"/>
                    </svg>
                </div>
                <h3 class="text-sm font-roboto font-bold text-slate-500 dark:text-white">Nouveaux Pharmacies</h3>
                <p class="text-2xl font-roboto font-bold dark:text-white">{{ $nouveauxPharmacies }}</p>
                <p class="text-xs font-roboto text-slate-500 mt-2">Ajoutés sur les 14 derniers jours</p>
            </div>
        
            <!-- Gérants Inactifs -->
            <div class="bg-white dark:bg-slate-800 p-4 rounded-2xl animate-fadeInScale">
                <div class="flex items-center justify-center w-10 h-10 rounded-lg bg-green-200 text-dark mb-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M15 12h6m-9-7a4 4 0 100 8 4 4 0 000-8zM4 20h8a4 4 0 00-8 0z"/>
                    </svg>
                </div>
                <h3 class="text-sm font-roboto font-bold text-slate-500 dark:text-white">Gérants Inactifs</h3>
                <p class="text-2xl font-roboto font-bold dark:text-white">{{ $inactiveGerants }}</p>
                <p class="text-xs font-roboto  text-slate-500 mt-2">Pas d’activité depuis 30 jours</p>
            </div>
        
        </div>
        
        

        {{-- <!-- ===== Graphiques ===== -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">

            <!-- Graphique global (lignes) -->
            <div class="bg-white p-6 rounded-xl shadow">
                <h2 class="text-lg font-semibold text-gray-700 mb-4">Évolution par mois</h2>
                <canvas id="globalChartLine"></canvas>
            </div>

        </div> --}}




        <!-- Assure-toi d'avoir Chart.js (v3+) dans ton layout -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<!-- Tailwind déjà présent dans ton projet (j'imagine) -->
<!-- Lucide icons (CDN) -->
<script src="https://unpkg.com/lucide@latest/dist/lucide.min.js"></script>


<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">

    <!-- Bar chart (mois) -->
    <div class="bg-white p-6 rounded-2xl ">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-lg font-roboto  text-gray-800">Évolution mensuelle</h2>
            <select id="moisFilter" class="border rounded px-2 py-1 text-sm">
                <option value="3">3 mois</option>
                <option value="6" selected>6 mois</option>
                <option value="12">12 mois</option>
            </select>
        </div>
        <canvas id="chartMois"></canvas>
    </div>

    <!-- Line chart (jours) -->
    <div class="bg-white p-6 rounded-2xl ">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-lg font-roboto  text-gray-800">Évolution journalière</h2>
            <select id="joursFilter" class="border rounded px-2 py-1 text-sm">
                <option value="10" selected>10 jours</option>
                <option value="20">20 jours</option>
                <option value="30">30 jours</option>
            </select>
        </div>
        <canvas id="chartJours"></canvas>
    </div>

</div>

<script>
document.addEventListener("DOMContentLoaded", () => {
    // --- Données depuis Laravel (chronologiques oldest->newest)
    const moisLabels = @json($monthsLabels); // length = 12
    const datasetMois = {
        medicaments: @json($medicamentsParMoisFormate),
        pharmacies: @json($pharmaciesParMoisFormate),
        admins: @json($adminsParMoisFormate)
    };

    const joursLabels = @json($joursLabels); // length = 30 (1..30)
    const datasetJours = {
        medicaments: @json($medicamentsParJoursFormate),
        pharmacies: @json($pharmaciesParJoursFormate),
        admins: @json($adminsParJoursFormate)
    };

    // --- Helper pour formater valeur et pourcent
    function formatNum(n) { return n; } // adapte si tu veux K/M etc.

    // ---------------- Bar chart (mois) ----------------
    const defaultMonths = 6; // comportement initial
    const labelsMo = moisLabels.slice(-defaultMonths);
    const dataMo = [
        datasetMois.medicaments.slice(-defaultMonths),
        datasetMois.pharmacies.slice(-defaultMonths),
        datasetMois.admins.slice(-defaultMonths)
    ];

    const ctxMois = document.getElementById('chartMois').getContext('2d');
    const chartMois = new Chart(ctxMois, {
        type: 'bar',
        data: {
            labels: labelsMo,
            datasets: [
                { label: "Médicaments", data: dataMo[0], backgroundColor: 'rgba(99,102,241,0.85)', borderRadius: 12 },
                { label: "Pharmacies",   data: dataMo[1], backgroundColor: 'rgba(187,247,208,0.85)', borderRadius: 12 },
                { label: "Admins",       data: dataMo[2], backgroundColor: 'rgba(245,158,11,0.85)', borderRadius: 12 }
            ]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { position: 'bottom' },
                tooltip: {
                    callbacks: {
                        title: (items) => {
                            return items[0].label || items[0].chart.data.labels[items[0].dataIndex];
                        },
                        label: (context) => {
                            const val = context.parsed.y ?? context.raw ?? 0;
                            const idx = context.dataIndex;
                            const ds = context.dataset.data;
                            const prev = idx > 0 ? ds[idx - 1] : null;
                            let pctStr = '';
                            if (prev === null) {
                                pctStr = ' —';
                            } else if (prev === 0) {
                                pctStr = ' (N/A prev=0)';
                            } else {
                                const pct = ((val - prev) / prev) * 100;
                                const arrow = pct >= 0 ? '↑' : '↓';
                                pctStr = ` (${arrow}${Math.abs(pct).toFixed(0)}% than prev)`;
                            }
                            return `${context.dataset.label} : ${formatNum(val)}${pctStr}`;
                        }
                    }
                }
            },
            scales: {
                x: { grid: { display: false }, stacked: false },
                y: { beginAtZero: true }
            }
        }
    });

    // ---------------- Line chart (jours) ----------------
    const defaultDays = 10;
    const labelsJ = joursLabels.slice(-defaultDays);
    const dataJ = [
        datasetJours.medicaments.slice(-defaultDays),
        datasetJours.pharmacies.slice(-defaultDays),
        datasetJours.admins.slice(-defaultDays)
    ];

    const ctxJours = document.getElementById('chartJours').getContext('2d');
    const chartJours = new Chart(ctxJours, {
        type: 'line',
        data: {
            labels: labelsJ,
            datasets: [
                { label: 'Médicaments', data: dataJ[0], borderColor: '#6366f1',   backgroundColor: 'rgba(99,102,241,0.15)', pointRadius: 3, fill: true, tension: 0.3 },
                { label: 'Pharmacies',   data: dataJ[1], borderColor: '#bbf7d0',   backgroundColor: 'rgba(187,247,208,0.12)',  pointRadius: 3, fill: true, tension: 0.3 },
                { label: 'Admins',       data: dataJ[2], borderColor: '#f59e0b',   backgroundColor: 'rgba(245,158,11,0.12)',  pointRadius: 3, fill: true, tension: 0.3 }
            ]
        },
        options: {
            responsive: true,
            plugins: { legend: { position: 'bottom' } },
            elements: { point: { radius: 4, hoverRadius: 6 } },
            scales: { y: { beginAtZero: true } }
        }
    });

    // ---------------- Filtrage dynamique ----------------
    document.getElementById('moisFilter').addEventListener('change', (e) => {
        const nb = parseInt(e.target.value, 10);
        chartMois.data.labels = moisLabels.slice(-nb);
        chartMois.data.datasets.forEach((d,i) => {
            const source = [datasetMois.medicaments, datasetMois.pharmacies, datasetMois.admins][i];
            d.data = source.slice(-nb);
        });
        chartMois.update();
    });

    document.getElementById('joursFilter').addEventListener('change', (e) => {
        const nb = parseInt(e.target.value, 10);
        chartJours.data.labels = joursLabels.slice(-nb);
        chartJours.data.datasets.forEach((d,i) => {
            const source = [datasetJours.medicaments, datasetJours.pharmacies, datasetJours.admins][i];
            d.data = source.slice(-nb);
        });
        chartJours.update();
    });

});
</script>



        <!-- ===== Tables ===== -->

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-5">

            <!-- Derniers gérants -->
            <div class="bg-white rounded-xl p-6">
                <div class="flex justify-between items-center mb-4">
                    <h6 class="text-lg font-roboto text-gray-700">Latest Managers</h6>
                </div>
        
                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm">
                        <thead>
                            <tr class="text-gray-400 text-xs font-roboto ">
                                <th class="px-4 py-2 font-roboto text-left ">Name</th>
                                <th class="px-4 py-2 font-roboto text-left ">Email</th>
                                <th class="px-4 py-2 font-roboto text-center ">Reg. Date</th>
                                <th class="px-4 py-2 font-roboto text-right ">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($gerants as $gerant)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-4 py-2  font-roboto font-light  text-gray-700">
                                        {{ $gerant->user->name }}
                                    </td>
                                    <td class="px-4 py-2  font-roboto font-light text-gray-500">
                                        {{ $gerant->user->email }}
                                    </td>
                                    <td class="px-4 py-2 font-roboto font-light  text-center text-gray-500">
                                        {{ $gerant->created_at->format('m/d/Y') }}
                                    </td>
                                    <td class="px-4 py-2 font-roboto font-thin  text-right">
                                        {{-- <a href="{{ route('gerants.update', $gerant->id_gerant) }}"
                                           class="px-3 py-1 text-xs font-semibold rounded-full bg-purple-100 text-purple-600 hover:bg-purple-200">
                                            View
                                        </a> --}}
                                        <button command="show-modal" commandfor="edit-gerant-{{ $gerant->id_gerant }}"
                                            class="px-3 py-1 text-xs font-roboto font-light rounded-full bg-green-200 text-gray-600 hover:bg-purple-200">
                                            Edit
                                        </button>

                                        @include('gerants.edit', ['gerant' => $gerant, 'pharmacies' => $pharmacies])
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        
            <!-- Dernières pharmacies -->
            <div class="bg-white rounded-xl p-6">
                <div class="flex justify-between items-center mb-4">
                    <h6 class="text-lg font-roboto text-gray-700">Latest Pharmacies</h6>
                </div>
        
                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm">
                        <thead>
                            <tr class="text-gray-400 text-xs font-roboto font-light">
                                <th class="px-4 py-2 text-left">Name</th>
                                <th class="px-4 py-2 text-left">Address</th>
                                <th class="px-4 py-2 text-center">Status</th>
                                <th class="px-4 py-2 text-center">Reg. Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pharmacies as $pharmacie)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-4 py-2  font-roboto font-light text-gray-700">
                                        {{ $pharmacie->nom }}
                                    </td>
                                    <td class="px-4 py-2 font-roboto font-light text-gray-500">
                                        {{ $pharmacie->adresse }}
                                    </td>
                                    <td class="p-4 text-center border-b dark:border-slate-600">
                                        @php
                                            $statusMap = [
                                                'valide' => ['Validé', 'bg-emerald-100 text-emerald-700'],
                                                'en_attent' => ['En_attent', 'bg-orange-100 text-orange-700'],
                                                'ferme' => ['Fermé', 'bg-red-100 text-red-700'],
                                            ];
                                            [$label, $color] = $statusMap[$pharmacie->statut] ?? ['En_attent', 'bg-orange-100 text-orange-400'];
                                        @endphp
                                        <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $color }}">{{ $label }}</span>
                                    </td>
                                    <td class="px-4 font-roboto font-light py-2 text-center text-gray-500">
                                        {{ $pharmacie->created_at->format('m/d/Y') }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        
        </div>
        
        

    </div>

    <!-- ===== Scripts ===== -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindplus/elements@1" type="module"></script>

    {{-- <script>
        document.addEventListener("DOMContentLoaded", () => {
            // Modals
            document.querySelectorAll("[command='show-modal']").forEach(button => {
                button.addEventListener("click", () => {
                    const targetId = button.getAttribute("commandfor");
                    const dialog = document.getElementById(targetId);
                    if (dialog) dialog.showModal();
                });
            });

            // ===== Graphiques =====
            const moisLabels = @json(array_keys($medicamentsParMoisFormate));

            // Global line chart
            const ctxGlobalLine = document.getElementById('globalChartLine');
            new Chart(ctxGlobalLine, {
                type: 'line',
                data: {
                    labels: moisLabels,
                    datasets: [{
                            label: 'Admins',
                            data: @json(array_values($adminsParMoisFormate)),
                            borderColor: '#3b82f6',
                            backgroundColor: 'rgba(59, 130, 246, 0.2)',
                            fill: false,
                            tension: 0.3
                        },
                        {
                            label: 'Pharmacies',
                            data: @json(array_values($pharmaciesParMoisFormate)),
                            borderColor: '#10b981',
                            backgroundColor: 'rgba(16, 185, 129, 0.2)',
                            fill: false,
                            tension: 0.3
                        },
                        {
                            label: 'Médicaments',
                            data: @json(array_values($medicamentsParMoisFormate)),
                            borderColor: '#f59e0b',
                            backgroundColor: 'rgba(245, 158, 11, 0.2)',
                            fill: false,
                            tension: 0.3
                        }
                    ]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top'
                        },
                        tooltip: {
                            mode: 'index',
                            intersect: false
                        }
                    },
                    interaction: {
                        mode: 'nearest',
                        axis: 'x',
                        intersect: false
                    },
                    scales: {
                        x: {
                            grid: {
                                display: false,
                                color: "rgba(57, 55, 55, 0.05)"
                            },

                            title: {
                                display: true,
                                text: 'Mois'
                            }
                        },
                        y: {
                            beginAtZero: true,

                            title: {
                                display: true,
                                text: 'Total'
                            }
                        }
                    }
                }
            });

        });
    </script> --}}

    <style>
        @keyframes fadeInScale {
  0% {
    opacity: 0;
    transform: scale(0.95);
  }
  100% {
    opacity: 1;
    transform: scale(1);
  }
}

.animate-fadeInScale {
  animation: fadeInScale 0.5s ease-out forwards;
}

    </style>
@endsection
