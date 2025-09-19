@extends('layouts.main')
@section('content')
    <div class="px-6 py-6 w-full bg-gray-100 dark:bg-slate-900">

        <!-- ===== Stat Cards ===== -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
            <!-- Gérants -->
            <div class="bg-white dark:bg-slate-800 p-4 rounded-2xl shadow">
                <h3 class="text-sm font-medium text-slate-500 dark:text-white">Gérants</h3>
                <p class="text-2xl font-bold dark:text-white">{{ $totalAdmins }}</p>
                <p class="text-xs text-slate-500 mt-2">
                    Last 30 days 
                <span class="px-2 py-1 rounded-full text-xs font-semibold {{ $adminsVariation >= 0 ? 'bg-green-100 text-green-600' : 'bg-red-100 text-red-600' }}">
                    {{ number_format($adminsVariation, 2) }}%
                </span>

                </p>
            </div>
        
            <!-- Pharmacies -->
            <div class="bg-white dark:bg-slate-800 p-4 rounded-2xl shadow">
                <h3 class="text-sm font-medium text-slate-500 dark:text-white">Pharmacies</h3>
                <p class="text-2xl font-bold dark:text-white">{{ $totalPharmacies }}</p>
                <p class="text-xs text-slate-500 mt-2">
                    Last 30 days 
                    <span class="{{ $pharmaciesVariation >= 0 ? 'bg-green-100 text-green-600' : 'bg-red-100 text-red-600'  }}">
                        {{ number_format($pharmaciesVariation, 2) }}%
                    </span>
                </p>
            </div>
        
            <!-- Nouveaux Pharmacies -->
            <div class="bg-white dark:bg-slate-800 p-4 rounded-2xl shadow">
                <h3 class="text-sm font-medium text-slate-500 dark:text-white">Nouveaux Pharmacies</h3>
                <p class="text-2xl font-bold dark:text-white">{{ $nouveauxPharmacies }}</p>
                <p class="text-xs text-slate-500 mt-2">Ajoutés sur les 14 derniers jours</p>
            </div>
        
            <!-- Gérants Inactifs -->
            <div class="bg-white dark:bg-slate-800 p-4 rounded-2xl shadow">
                <h3 class="text-sm font-medium text-slate-500 dark:text-white">Gérants Inactifs</h3>
                <p class="text-2xl font-bold dark:text-white">{{ $inactiveGerants }}</p>
                <p class="text-xs text-slate-500 mt-2">Pas d’activité depuis 30 jours</p>
            </div>
        </div>
        

        <!-- ===== Graphiques ===== -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">

            <!-- Graphique global (lignes) -->
            <div class="bg-white p-6 rounded-xl shadow">
                <h2 class="text-lg font-semibold text-gray-700 mb-4">Évolution par mois</h2>
                <canvas id="globalChartLine"></canvas>
            </div>

            <!-- Graphique Médicaments par mois (barre) -->
            <div class="bg-white p-6 rounded-xl shadow">
                <h2 class="text-lg font-semibold text-gray-700 mb-4">Médicaments ajoutés par mois</h2>
                <canvas id="medicamentsChartBar"></canvas>
            </div>

        </div>

        <!-- ===== Tables ===== -->

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-5">

            <!-- Derniers gérants -->
            <div class="bg-white shadow rounded-xl p-6">
                <div class="flex justify-between items-center mb-4">
                    <h6 class="text-lg font-semibold text-gray-700">Latest Managers</h6>
                </div>
        
                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm">
                        <thead>
                            <tr class="text-gray-400 uppercase text-xs font-bold">
                                <th class="px-4 py-2 text-left">Name</th>
                                <th class="px-4 py-2 text-left">Email</th>
                                <th class="px-4 py-2 text-center">Reg. Date</th>
                                <th class="px-4 py-2 text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($gerants as $gerant)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-4 py-2 font-medium text-gray-700">
                                        {{ $gerant->user->name }}
                                    </td>
                                    <td class="px-4 py-2 text-gray-500">
                                        {{ $gerant->user->email }}
                                    </td>
                                    <td class="px-4 py-2 text-center text-gray-500">
                                        {{ $gerant->created_at->format('m/d/Y') }}
                                    </td>
                                    <td class="px-4 py-2 text-right">
                                        <a href="{{ route('gerants.update', $gerant->id_gerant) }}"
                                           class="px-3 py-1 text-xs font-semibold rounded-full bg-purple-100 text-purple-600 hover:bg-purple-200">
                                            View
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        
            <!-- Dernières pharmacies -->
            <div class="bg-white shadow rounded-xl p-6">
                <div class="flex justify-between items-center mb-4">
                    <h6 class="text-lg font-semibold text-gray-700">Latest Pharmacies</h6>
                </div>
        
                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm">
                        <thead>
                            <tr class="text-gray-400 uppercase text-xs font-bold">
                                <th class="px-4 py-2 text-left">Name</th>
                                <th class="px-4 py-2 text-left">Address</th>
                                <th class="px-4 py-2 text-center">Status</th>
                                <th class="px-4 py-2 text-center">Reg. Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pharmacies as $pharmacie)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-4 py-2 font-medium text-gray-700">
                                        {{ $pharmacie->nom }}
                                    </td>
                                    <td class="px-4 py-2 text-gray-500">
                                        {{ $pharmacie->adresse }}
                                    </td>
                                    <td class="px-4 py-2 text-center">
                                        @php
                                            $statusMap = [
                                                'valide' => ['Active', 'text-green-600'],
                                                'en_attent' => ['Pending', 'text-purple-600'],
                                                'ferme' => ['Expired', 'text-red-600'],
                                            ];
                                            [$label, $color] = $statusMap[$pharmacie->statut] ?? ['Unknown', 'text-gray-500'];
                                        @endphp
                                        <span class="font-semibold {{ $color }}">{{ $label }}</span>
                                    </td>
                                    <td class="px-4 py-2 text-center text-gray-500">
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

    <script>
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

            // Medicaments bar chart
            const ctxMedBar = document.getElementById('medicamentsChartBar');
            new Chart(ctxMedBar, {
                type: 'bar',
                data: {
                    labels: moisLabels,
                    datasets: [{
                        label: 'Médicaments',
                        data: @json(array_values($medicamentsParMoisFormate)),
                        backgroundColor: '#3b82f6'
                    }]
                },
                options: {
                    responsive: true,
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
                            beginAtZero: true
                        }
                    }
                }
            });
        });
    </script>
@endsection
