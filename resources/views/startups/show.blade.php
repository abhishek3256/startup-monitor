@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="glass-text">{{ $startup->name }}</h1>
        <div>
            <a href="{{ route('startups.edit', $startup) }}" class="btn glass-btn me-2">
                <i class="fas fa-edit"></i> Edit
            </a>
            <a href="{{ route('startups.index') }}" class="btn glass-btn">
                <i class="fas fa-arrow-left"></i> Back
            </a>
        </div>
    </div>

    <div class="row g-4">
        <!-- Equity Distribution -->
        <div class="col-md-6">
            <div class="glass-card h-100">
                <h3 class="glass-text mb-4">Equity Distribution</h3>
                <div class="row">
                    <div class="col-md-6">
                        <canvas id="equityChart"></canvas>
                    </div>
                    <div class="col-md-6">
                        <div class="investor-list">
                            @foreach($investments as $investment)
                            <div class="investor-item glass-item mb-3">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h5 class="mb-1">{{ $investment->investor->name }}</h5>
                                        <small class="text-muted">{{ $investment->investor->type }}</small>
                                    </div>
                                    <div class="text-end">
                                        <h5 class="mb-1">₹{{ number_format($investment->investment_amount) }}</h5>
                                        <small class="text-success">{{ number_format($investment->equity_offered, 1) }}% Equity</small>
                                    </div>
                                </div>
                                <hr class="my-2">
                                <div class="d-flex justify-content-between align-items-center">
                                    <small class="text-muted">Round: {{ ucfirst(str_replace('_', ' ', $investment->round)) }}</small>
                                    <small class="text-muted">{{ $investment->investment_date->format('M d, Y') }}</small>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Milestone Progress -->
        <div class="col-md-6">
            <div class="glass-card h-100">
                <h3 class="glass-text mb-4">Milestone Progress</h3>
                <div class="milestone-list">
                    @foreach($milestones as $milestone)
                    <div class="milestone-item glass-item mb-3">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <h5 class="mb-0">{{ $milestone->title }}</h5>
                            <span class="badge glass-badge {{ $milestone->status == 'completed' ? 'bg-success' : ($milestone->status == 'in_progress' ? 'bg-primary' : 'bg-warning') }}">
                                {{ ucfirst($milestone->status) }}
                            </span>
                        </div>
                        <div class="progress glass-progress mb-2">
                            <div class="progress-bar" role="progressbar" style="width: {{ $milestone->completion_percentage }}%">
                                {{ $milestone->completion_percentage }}%
                            </div>
                        </div>
                        <small class="text-muted">Target: {{ $milestone->target_date->format('M d, Y') }}</small>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Startup Statistics -->
        <div class="col-md-4">
            <div class="glass-card h-100">
                <h3 class="glass-text mb-4">Statistics</h3>
                <div class="stats-grid">
                    <div class="stat-item glass-item">
                        <i class="fas fa-money-bill-wave text-success"></i>
                        <h4>₹{{ number_format($totalFunding) }}</h4>
                        <p>Total Funding</p>
                    </div>
                    <div class="stat-item glass-item">
                        <i class="fas fa-users text-primary"></i>
                        <h4>{{ $investments->count() }}</h4>
                        <p>Investors</p>
                    </div>
                    <div class="stat-item glass-item">
                        <i class="fas fa-tasks text-info"></i>
                        <h4>{{ number_format($milestoneCompletion, 1) }}%</h4>
                        <p>Milestone Completion</p>
                    </div>
                    <div class="stat-item glass-item">
                        <i class="fas fa-calendar text-warning"></i>
                        <h4>{{ $startup->founded_date->format('M Y') }}</h4>
                        <p>Founded</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Activity -->
        <div class="col-md-8">
            <div class="glass-card h-100">
                <h3 class="glass-text mb-4">Recent Activity</h3>
                <div class="activity-timeline">
                    @foreach($recentActivities as $activity)
                    <div class="activity-item glass-item">
                        <div class="d-flex align-items-center">
                            <div class="activity-icon glass-icon bg-{{ $activity->color }}">
                                <i class="fas fa-{{ $activity->icon }}"></i>
                            </div>
                            <div class="activity-content ms-3">
                                <p class="mb-1">{{ $activity->description }}</p>
                                <small class="text-muted">{{ $activity->created_at->diffForHumans() }}</small>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.glass-card {
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(10px);
    border-radius: 15px;
    padding: 20px;
    border: 1px solid rgba(255, 255, 255, 0.2);
    box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
}

.glass-text {
    color: #2c3e50;
    font-weight: 600;
}

.glass-btn {
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(5px);
    border: 1px solid rgba(255, 255, 255, 0.2);
    color: #2c3e50;
    transition: all 0.3s ease;
}

.glass-btn:hover {
    background: rgba(255, 255, 255, 0.2);
    transform: translateY(-2px);
}

.glass-item {
    background: rgba(255, 255, 255, 0.05);
    border-radius: 10px;
    padding: 15px;
    transition: all 0.3s ease;
}

.glass-item:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
}

.glass-badge {
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(5px);
    border: 1px solid rgba(255, 255, 255, 0.2);
}

.glass-progress {
    background: rgba(255, 255, 255, 0.1);
    height: 10px;
    border-radius: 5px;
}

.glass-progress .progress-bar {
    background: linear-gradient(45deg, #4CAF50, #8BC34A);
    border-radius: 5px;
}

.stats-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 15px;
}

.stat-item {
    text-align: center;
    padding: 15px;
}

.stat-item i {
    font-size: 24px;
    margin-bottom: 10px;
}

.stat-item h4 {
    font-size: 18px;
    margin-bottom: 5px;
}

.stat-item p {
    margin: 0;
    color: #6c757d;
    font-size: 14px;
}

.activity-timeline {
    position: relative;
}

.activity-item {
    margin-bottom: 20px;
    padding: 15px;
}

.activity-icon {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
}

.activity-content {
    flex: 1;
}

.glass-icon {
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(5px);
    border: 1px solid rgba(255, 255, 255, 0.2);
}
</style>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const ctx = document.getElementById('equityChart').getContext('2d');
    const investments = @json($investments);
    
    new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: investments.map(inv => inv.investor.name),
            datasets: [{
                data: investments.map(inv => (inv.investment_amount / {{ $totalFunding }}) * 100),
                backgroundColor: [
                    '#4CAF50',
                    '#2196F3',
                    '#FFC107',
                    '#9C27B0',
                    '#FF5722',
                    '#607D8B'
                ],
                borderWidth: 0
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                }
            },
            cutout: '70%'
        }
    });
});
</script>
@endpush
@endsection 