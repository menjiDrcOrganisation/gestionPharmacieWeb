@extends('layouts.main')
@section('content')
    <div class="px-6 py-6 w-full bg-slate-50 dark:bg-slate-900">

        <!-- ===== Stat Cards ===== -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
            <div class="bg-white dark:bg-slate-800 p-4 rounded-2xl shadow">
                <h3 class="text-sm font-medium text-slate-500 dark:text-white">Gerant</h3>
                <p class="text-2xl font-bold dark:text-white">{{ $totalAdmins }}</p>
            </div>
            <div class="bg-white dark:bg-slate-800 p-4 rounded-2xl shadow">
                <h3 class="text-sm font-medium text-slate-500 dark:text-white">Pharmacies</h3>
                <p class="text-2xl font-bold dark:text-white">{{ $totalPharmacies }}</p>
            </div>
            <div class="bg-white dark:bg-slate-800 p-4 rounded-2xl shadow">
                <h3 class="text-sm font-medium text-slate-500 dark:text-white">Médicaments</h3>
                <p class="text-2xl font-bold dark:text-white">{{ $totalMedicaments }}</p>
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
