@extends('user.layouts.template')
@section('content')

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<!-- Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
<link rel="stylesheet" href="{{asset('dasboard/user.css')}}">

<div class="dashboard-background">
    <div class="container-fluid">
        <!-- Carte de bienvenue -->
        <div class="welcome-card">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h2>Bonjour, {{ Auth::user()->name.' '.Auth::user()->prenom }}!</h2>
                    <p class="mb-0">Bienvenue sur votre tableau de bord. Gérez vos demandes d'actes d'état civil en un seul endroit.</p>
                </div>
                <div class="col-md-3 mairie">
                    <p class="mb-0">Mairie {{Auth::user()->commune}} </p>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Cartes de statistiques -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="stat-card stat-card-birth">
                    <div class="stat-icon">
                        <i class="fas fa-baby"></i>
                    </div>
                    <div class="stat-number">{{ $naissancesCount ?? 0 }}</div>
                    <h4>Naissances</h4>
                    <p>Demandes d'actes de naissance</p>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="stat-card stat-card-death">
                    <div class="stat-icon">
                        <i class="fas fa-cross"></i>
                    </div>
                    <div class="stat-number">{{ $decesCount ?? 0 }}</div>
                    <h4>Décès</h4>
                    <p>Demandes d'actes de décès</p>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="stat-card stat-card-marriage">
                    <div class="stat-icon">
                        <i class="fas fa-ring"></i>
                    </div>
                    <div class="stat-number">{{ $mariagesCount ?? 0 }}</div>
                    <h4>Mariages</h4>
                    <p>Demandes d'actes de mariage</p>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="stat-card" style="background: linear-gradient(135deg, #6f42c1, #4a2d7c);">
                    <div class="stat-icon">
                        <i class="fas fa-chart-pie"></i>
                    </div>
                    <div class="stat-number">{{ $totalCount ?? 0 }}</div>
                    <h4>Total</h4>
                    <p>Toutes vos demandes</p>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Graphique circulaire -->
            <div class="col-lg-6 mb-4">
                <div class="card-dashboard">
                    <div class="card-body">
                        <h4 class="card-title">Répartition des demandes</h4>
                        <div class="chart-container">
                            <canvas id="typeChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Graphique des états -->
            <div class="col-lg-6 mb-4">
                <div class="card-dashboard">
                    <div class="card-body">
                        <h4 class="card-title">Statut des demandes</h4>
                        <div class="chart-container">
                            <canvas id="statusChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Activités récentes -->
            <div class="col-lg-12">
                <div class="card-dashboard">
                    <div class="card-body">
                        <h4 class="card-title">Activités Récentes</h4>
                        
                        <div class="recent-activities">
                            @if($recentActivities && count($recentActivities) > 0)
                                @foreach($recentActivities as $activity)
                                <div class="activity-item">
                                    <div class="activity-icon 
                                        @if($activity['type'] == 'naissance') icon-birth 
                                        @elseif($activity['type'] == 'décès') icon-death 
                                        @else icon-marriage @endif">
                                        @if($activity['type'] == 'naissance')
                                            <i class="fas fa-baby"></i>
                                        @elseif($activity['type'] == 'décès')
                                            <i class="fas fa-cross"></i>
                                        @else
                                            <i class="fas fa-ring"></i>
                                        @endif
                                    </div>
                                    <div class="activity-content">
                                        <div class="activity-title">
                                            Demande d'acte de {{ $activity['type'] }} - {{ $activity['reference'] }}
                                        </div>
                                        <div class="activity-time">
                                            {{ $activity['date'] }} • 
                                            Statut: <span class="badge-status 
                                                @if($activity['etat'] == 'en attente') badge-pending 
                                                @elseif($activity['etat'] == 'réçu') badge-received 
                                                @elseif($activity['etat'] == 'terminé') badge-completed 
                                                @else badge-secondary @endif">
                                                {{ $activity['etat'] }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            @else
                                <p class="text-center text-muted py-3">Aucune activité récente</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Graphique circulaire pour les types de demandes
        const typeCtx = document.getElementById('typeChart').getContext('2d');
        const typeChart = new Chart(typeCtx, {
            type: 'doughnut',
            data: {
                labels: ['Naissances', 'Décès', 'Mariages'],
                datasets: [{
                    data: [{{ $naissancesCount ?? 0 }}, {{ $decesCount ?? 0 }}, {{ $mariagesCount ?? 0 }}],
                    backgroundColor: [
                        'rgba(0, 128, 0, 0.7)',
                        'rgba(108, 117, 125, 0.7)',
                        'rgba(255, 165, 0, 0.7)'
                    ],
                    borderColor: [
                        'rgba(0, 128, 0, 1)',
                        'rgba(108, 117, 125, 1)',
                        'rgba(255, 165, 0, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                const label = context.label || '';
                                const value = context.raw || 0;
                                const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                const percentage = Math.round((value / total) * 100);
                                return `${label}: ${value} (${percentage}%)`;
                            }
                        }
                    }
                }
            }
        });

        // Graphique à barres pour les statuts
        const statusCtx = document.getElementById('statusChart').getContext('2d');
        const statusChart = new Chart(statusCtx, {
            type: 'bar',
            data: {
                labels: ['En attente', 'Réçues', 'Terminées'],
                datasets: [{
                    label: 'Nombre de demandes',
                    data: [{{ $pendingCount ?? 0 }}, {{ $receivedCount ?? 0 }}, {{ $completedCount ?? 0 }}],
                    backgroundColor: [
                        'rgba(255, 193, 7, 0.7)',
                        'rgba(40, 167, 69, 0.7)',
                        'rgba(23, 162, 184, 0.7)'
                    ],
                    borderColor: [
                        'rgba(255, 193, 7, 1)',
                        'rgba(40, 167, 69, 1)',
                        'rgba(23, 162, 184, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });
    });
</script>

@endsection