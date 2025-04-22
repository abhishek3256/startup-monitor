@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container">
    <h1 class="mb-4 glass-text">Dashboard</h1>

    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card glass-card p-3">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="mb-0">Total Startups</h6>
                        <h2 class="mb-0">{{ $totalStartups }}</h2>
                    </div>
                    <div class="fs-1 text-primary">
                        <i class="fas fa-rocket"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card glass-card p-3">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="mb-0">Total Investors</h6>
                        <h2 class="mb-0">{{ $totalInvestors }}</h2>
                    </div>
                    <div class="fs-1 text-success">
                        <i class="fas fa-hand-holding-usd"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card glass-card p-3">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="mb-0">Total Funding</h6>
                        <h2 class="mb-0">₹{{ number_format($totalFunding, 0) }}</h2>
                    </div>
                    <div class="fs-1 text-warning">
                        <i class="fas fa-money-bill-wave"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card glass-card p-3">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="mb-0">Pending Milestones</h6>
                        <h2 class="mb-0">{{ $pendingMilestones }}</h2>
                    </div>
                    <div class="fs-1 text-info">
                        <i class="fas fa-flag"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts -->
    <div class="row mb-4">
        <div class="col-md-6">
            <div class="card glass-card">
                <div class="card-body">
                    <h5 class="card-title">Industry Distribution</h5>
                    <canvas id="industryChart"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card glass-card">
                <div class="card-body">
                    <h5 class="card-title">Funding by Stage</h5>
                    <canvas id="fundingChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Activity -->
    <div class="row">
        <div class="col-md-4">
            <div class="card glass-card">
                <div class="card-body">
                    <h5 class="card-title">
                        <i class="fas fa-rocket me-2"></i>Recent Startups
                    </h5>
                    <div class="list-group list-group-flush">
                        @foreach($recentStartups as $startup)
                            <div class="list-group-item bg-transparent text-white border-light">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="mb-0">{{ $startup->name }}</h6>
                                        <small>{{ $startup->industry }}</small>
                                    </div>
                                    <span class="badge bg-primary">{{ $startup->stage }}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card glass-card">
                <div class="card-body">
                    <h5 class="card-title">
                        <i class="fas fa-hand-holding-usd me-2"></i>Recent Investments
                    </h5>
                    <div class="list-group list-group-flush">
                        @foreach($recentInvestments as $investment)
                            <div class="list-group-item bg-transparent text-white border-light">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="mb-0">{{ $investment->startup->name }}</h6>
                                        <small>{{ $investment->investor->name }}</small>
                                    </div>
                                    <span class="badge bg-success">₹{{ number_format($investment->investment_amount, 0) }}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card glass-card">
                <div class="card-body">
                    <h5 class="card-title">
                        <i class="fas fa-flag-checkered me-2"></i>Upcoming Milestones
                    </h5>
                    <div class="list-group list-group-flush">
                        @foreach($upcomingMilestones as $milestone)
                            <div class="list-group-item bg-transparent text-white border-light">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="mb-0">{{ $milestone->title }}</h6>
                                        <small>{{ $milestone->startup->name }}</small>
                                    </div>
                                    <span class="badge bg-info">{{ $milestone->target_date->format('M d, Y') }}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .glass-text {
        color: #fff;
        text-shadow: 0 0 10px rgba(255, 255, 255, 0.5);
    }
    
    .glass-card {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        transition: all 0.3s ease;
    }
    
    .glass-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
    }
    
    .list-group-item {
        transition: all 0.3s ease;
    }
    
    .list-group-item:hover {
        background: rgba(255, 255, 255, 0.1) !important;
        transform: translateX(5px);
    }
    
    .badge {
        transition: all 0.3s ease;
    }
    
    .list-group-item:hover .badge {
        transform: scale(1.1);
        box-shadow: 0 0 10px rgba(255, 255, 255, 0.3);
    }
</style>

@push('scripts')
<script>
    // Industry Distribution Chart
    const industryCtx = document.getElementById('industryChart').getContext('2d');
    new Chart(industryCtx, {
        type: 'doughnut',
        data: {
            labels: {!! json_encode($industryStats->pluck('industry')) !!},
            datasets: [{
                data: {!! json_encode($industryStats->pluck('count')) !!},
                backgroundColor: [
                    '#FF6384',
                    '#36A2EB',
                    '#FFCE56',
                    '#4BC0C0',
                    '#9966FF'
                ]
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    labels: {
                        color: '#fff'
                    }
                }
            }
        }
    });

    // Funding by Stage Chart
    const fundingCtx = document.getElementById('fundingChart').getContext('2d');
    new Chart(fundingCtx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($fundingByStage->pluck('stage')) !!},
            datasets: [{
                label: 'Total Funding (₹)',
                data: {!! json_encode($fundingByStage->pluck('total')) !!},
                backgroundColor: 'rgba(54, 162, 235, 0.5)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    labels: {
                        color: '#fff'
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        color: '#fff'
                    }
                },
                x: {
                    ticks: {
                        color: '#fff'
                    }
                }
            }
        }
    });
</script>
@endpush
@endsection 