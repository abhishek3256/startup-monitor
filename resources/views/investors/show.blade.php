@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-md-8">
            <h1 class="glass-text">
                <i class="fas fa-user-tie me-2"></i>{{ $investor->name }}
            </h1>
            <p class="text-muted">{{ $investor->type }} Investor</p>
        </div>
        <div class="col-md-4 text-end">
            <button type="button" class="btn btn-primary glass-btn" data-bs-toggle="modal" data-bs-target="#investModal">
                <i class="fas fa-plus"></i> New Investment
            </button>
        </div>
    </div>

    <div class="row">
        <!-- Investment Portfolio -->
        <div class="col-md-8">
            <div class="card glass-card mb-4">
                <div class="card-body">
                    <h5 class="card-title glass-text">
                        <i class="fas fa-chart-pie me-2"></i>Investment Portfolio
                    </h5>
                    <div class="row">
                        @foreach($investments as $investment)
                            <div class="col-md-6 mb-3">
                                <div class="glass-card h-100 investment-card">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-start">
                                            <div>
                                                <h6 class="mb-1">{{ $investment->startup->name }}</h6>
                                                <p class="text-muted mb-2">{{ $investment->startup->industry }}</p>
                                            </div>
                                            <span class="badge bg-primary glass-badge">
                                                {{ number_format($investment->equity_offered, 1) }}% Equity
                                            </span>
                                        </div>
                                        <div class="progress glass-progress mb-2">
                                            <div class="progress-bar" role="progressbar" 
                                                style="width: {{ $investment->equity_offered }}%;" 
                                                aria-valuenow="{{ $investment->equity_offered }}" 
                                                aria-valuemin="0" 
                                                aria-valuemax="100">
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-between text-muted">
                                            <small>Investment: ₹{{ number_format($investment->investment_amount, 0) }}</small>
                                            <small>Date: {{ $investment->investment_date->format('M d, Y') }}</small>
                                        </div>
                                        <hr class="my-2">
                                        <div class="d-flex justify-content-between">
                                            <small class="text-muted">Round: {{ ucfirst(str_replace('_', ' ', $investment->round)) }}</small>
                                            <small class="text-muted">Valuation: ₹{{ number_format($investment->valuation, 0) }}</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Startup Milestones -->
            <div class="card glass-card">
                <div class="card-body">
                    <h5 class="card-title glass-text">
                        <i class="fas fa-flag-checkered me-2"></i>Portfolio Milestones
                    </h5>
                    <div class="accordion" id="milestoneAccordion">
                        @foreach($investments as $investment)
                            <div class="accordion-item glass-accordion">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed glass-btn" type="button" 
                                        data-bs-toggle="collapse" 
                                        data-bs-target="#collapse{{ $investment->id }}">
                                        {{ $investment->startup->name }}
                                    </button>
                                </h2>
                                <div id="collapse{{ $investment->id }}" class="accordion-collapse collapse" 
                                    data-bs-parent="#milestoneAccordion">
                                    <div class="accordion-body">
                                        @foreach($investment->startup->milestones as $milestone)
                                            <div class="milestone-item glass-list-item mb-3">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div>
                                                        <h6 class="mb-1">{{ $milestone->title }}</h6>
                                                        <small class="text-muted">{{ $milestone->description }}</small>
                                                    </div>
                                                    <div class="text-end">
                                                        <span class="badge bg-{{ $milestone->status == 'completed' ? 'success' : ($milestone->status == 'in_progress' ? 'primary' : 'warning') }} glass-badge">
                                                            {{ ucfirst($milestone->status) }}
                                                        </span>
                                                        <div class="progress glass-progress mt-2" style="width: 100px;">
                                                            <div class="progress-bar" role="progressbar" 
                                                                style="width: {{ $milestone->completion_percentage }}%;" 
                                                                aria-valuenow="{{ $milestone->completion_percentage }}" 
                                                                aria-valuemin="0" 
                                                                aria-valuemax="100">
                                                                {{ $milestone->completion_percentage }}%
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <!-- Investment Stats -->
        <div class="col-md-4">
            <div class="card glass-card mb-4">
                <div class="card-body">
                    <h5 class="card-title glass-text">
                        <i class="fas fa-chart-line me-2"></i>Investment Statistics
                    </h5>
                    <div class="stat-item mb-3">
                        <h6>Total Investment</h6>
                        <h3 class="text-primary">₹{{ number_format($totalInvestment, 0) }}</h3>
                    </div>
                    <div class="stat-item mb-3">
                        <h6>Number of Startups</h6>
                        <h3 class="text-success">{{ $investments->count() }}</h3>
                    </div>
                    <div class="stat-item">
                        <h6>Average Ownership</h6>
                        <h3 class="text-info">{{ number_format($averageOwnership, 1) }}%</h3>
                    </div>
                </div>
            </div>

            <!-- Investment Distribution Chart -->
            <div class="card glass-card">
                <div class="card-body">
                    <h5 class="card-title glass-text">
                        <i class="fas fa-chart-pie me-2"></i>Investment Distribution
                    </h5>
                    <canvas id="investmentChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Investment Modal -->
<div class="modal fade" id="investModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content glass-modal">
            <div class="modal-header">
                <h5 class="modal-title glass-text">New Investment</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('investments.store') }}" method="POST">
                @csrf
                <input type="hidden" name="investor_id" value="{{ $investor->id }}">
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Startup</label>
                        <select class="form-select glass-select" name="startup_id" required>
                            <option value="">Select Startup</option>
                            @foreach($availableStartups as $startup)
                                <option value="{{ $startup->id }}">{{ $startup->name }} ({{ $startup->industry }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Investment Amount (₹)</label>
                        <input type="number" step="0.01" class="form-control glass-input" name="investment_amount" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Equity Offered (%)</label>
                        <input type="number" step="0.01" class="form-control glass-input" name="equity_offered" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Valuation (₹)</label>
                        <input type="number" step="0.01" class="form-control glass-input" name="valuation" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Investment Round</label>
                        <select class="form-select glass-select" name="round" required>
                            <option value="">Select Round</option>
                            <option value="seed">Seed</option>
                            <option value="pre_seed">Pre-seed</option>
                            <option value="series_a">Series A</option>
                            <option value="series_b">Series B</option>
                            <option value="series_c">Series C</option>
                            <option value="series_d">Series D</option>
                            <option value="bridge">Bridge</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Investment Date</label>
                        <input type="date" class="form-control glass-input" name="investment_date" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Terms</label>
                        <textarea class="form-control glass-input" name="terms" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary glass-btn" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary glass-btn">Invest</button>
                </div>
            </form>
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
    
    .investment-card {
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(255, 255, 255, 0.1);
        transition: all 0.3s ease;
    }
    
    .investment-card:hover {
        background: rgba(255, 255, 255, 0.1);
        transform: translateY(-3px);
    }
    
    .glass-progress {
        background: rgba(255, 255, 255, 0.1);
        height: 8px;
        border-radius: 4px;
    }
    
    .glass-progress .progress-bar {
        background: linear-gradient(90deg, rgba(13, 110, 253, 0.7), rgba(13, 110, 253, 0.9));
        transition: width 1s ease-in-out;
    }
    
    .glass-badge {
        background: rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(5px);
        border: 1px solid rgba(255, 255, 255, 0.3);
        transition: all 0.3s ease;
    }
    
    .glass-accordion {
        background: transparent;
        border: none;
    }
    
    .glass-accordion .accordion-button {
        background: rgba(255, 255, 255, 0.1);
        color: #fff;
        border: 1px solid rgba(255, 255, 255, 0.2);
    }
    
    .glass-accordion .accordion-button:not(.collapsed) {
        background: rgba(13, 110, 253, 0.2);
        color: #fff;
    }
    
    .glass-accordion .accordion-body {
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(255, 255, 255, 0.1);
    }
    
    .glass-modal {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.2);
    }
    
    .glass-select, .glass-input {
        background: rgba(255, 255, 255, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.2);
        color: #fff;
    }
    
    .glass-select:focus, .glass-input:focus {
        background: rgba(255, 255, 255, 0.15);
        border-color: rgba(255, 255, 255, 0.3);
        color: #fff;
        box-shadow: 0 0 10px rgba(255, 255, 255, 0.1);
    }
    
    .stat-item {
        padding: 1rem;
        border-radius: 8px;
        background: rgba(255, 255, 255, 0.05);
        transition: all 0.3s ease;
    }
    
    .stat-item:hover {
        background: rgba(255, 255, 255, 0.1);
        transform: translateX(5px);
    }
</style>

@push('scripts')
<script>
    // Investment Distribution Chart
    const ctx = document.getElementById('investmentChart').getContext('2d');
    new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: {!! json_encode($investments->pluck('startup.name')) !!},
            datasets: [{
                data: {!! json_encode($investments->pluck('ownership_percentage')) !!},
                backgroundColor: [
                    'rgba(255, 99, 132, 0.8)',
                    'rgba(54, 162, 235, 0.8)',
                    'rgba(255, 206, 86, 0.8)',
                    'rgba(75, 192, 192, 0.8)',
                    'rgba(153, 102, 255, 0.8)'
                ]
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        color: '#fff'
                    }
                }
            }
        }
    });
</script>
@endpush
@endsection 