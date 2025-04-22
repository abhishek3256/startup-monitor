@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="glass-text">Milestones</h1>
        <a href="{{ route('milestones.create') }}" class="btn btn-primary glass-btn">
            <i class="fas fa-plus"></i> Add New Milestone
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show glass-alert" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row">
        @foreach($milestones as $milestone)
            <div class="col-md-4 mb-4">
                <div class="card glass-card h-100 milestone-card">
                    <div class="card-body">
                        <div class="milestone-icon mb-3">
                            <i class="fas fa-flag-checkered"></i>
                        </div>
                        <h5 class="card-title">{{ $milestone->title }}</h5>
                        <p class="card-text text-muted">{{ Str::limit($milestone->description, 100) }}</p>
                        
                        <div class="mb-3">
                            <h6>Startup</h6>
                            <p class="text-muted startup-name">{{ $milestone->startup->name }}</p>
                        </div>

                        <div class="mb-3">
                            <h6>Target Date</h6>
                            <p class="text-muted date-display">{{ $milestone->target_date->format('M d, Y') }}</p>
                        </div>

                        <div class="mb-3">
                            <h6>Status</h6>
                            <span class="badge status-badge bg-{{ $milestone->status == 'completed' ? 'success' : ($milestone->status == 'in_progress' ? 'primary' : 'warning') }}">
                                {{ ucfirst($milestone->status) }}
                            </span>
                        </div>
                        
                        <div class="mb-3">
                            <h6>Category</h6>
                            <span class="badge category-badge">
                                {{ ucfirst($milestone->category) }}
                            </span>
                        </div>
                        
                        <div class="mb-3">
                            <h6>Priority</h6>
                            <span class="badge priority-badge bg-{{ $milestone->priority == 'high' ? 'danger' : ($milestone->priority == 'medium' ? 'warning' : 'info') }}">
                                {{ ucfirst($milestone->priority) }}
                            </span>
                        </div>
                        
                        <div class="mb-3">
                            <h6>Completion</h6>
                            <div class="progress glass-progress">
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
                    <div class="card-footer bg-transparent border-0">
                        <div class="btn-group w-100">
                            <a href="{{ route('milestones.show', $milestone) }}" class="btn btn-outline-primary glass-btn">
                                <i class="fas fa-eye"></i> View
                            </a>
                            <a href="{{ route('milestones.edit', $milestone) }}" class="btn btn-outline-secondary glass-btn">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <form action="{{ route('milestones.destroy', $milestone) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger glass-btn" onclick="return confirm('Are you sure?')">
                                    <i class="fas fa-trash"></i> Delete
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="d-flex justify-content-center mt-4">
        {{ $milestones->links() }}
    </div>
</div>

<style>
    .glass-text {
        color: #fff;
        text-shadow: 0 0 10px rgba(255, 255, 255, 0.5);
    }
    
    .glass-alert {
        background: rgba(40, 167, 69, 0.2);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        color: #fff;
    }
    
    .glass-btn {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(5px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        transition: all 0.3s ease;
    }
    
    .glass-btn:hover {
        background: rgba(255, 255, 255, 0.2);
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }
    
    .milestone-card {
        transition: all 0.3s ease;
        overflow: hidden;
        position: relative;
    }
    
    .milestone-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
    }
    
    .milestone-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, rgba(255, 255, 255, 0.1), rgba(255, 255, 255, 0));
        z-index: 1;
        pointer-events: none;
    }
    
    .milestone-icon {
        font-size: 2.5rem;
        color: rgba(255, 255, 255, 0.8);
        text-align: center;
        margin-bottom: 1rem;
        transition: all 0.3s ease;
    }
    
    .milestone-card:hover .milestone-icon {
        transform: scale(1.1) rotate(5deg);
        color: rgba(255, 255, 255, 1);
    }
    
    .status-badge, .category-badge, .priority-badge {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(5px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        transition: all 0.3s ease;
        padding: 0.5em 1em;
    }
    
    .milestone-card:hover .status-badge, 
    .milestone-card:hover .category-badge, 
    .milestone-card:hover .priority-badge {
        transform: scale(1.05);
        box-shadow: 0 0 10px rgba(255, 255, 255, 0.3);
    }
    
    .glass-progress {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(5px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        height: 10px;
        border-radius: 5px;
        overflow: hidden;
    }
    
    .glass-progress .progress-bar {
        background: linear-gradient(90deg, rgba(13, 110, 253, 0.7), rgba(13, 110, 253, 0.9));
        transition: width 1s ease-in-out;
    }
    
    .startup-name, .date-display {
        transition: all 0.3s ease;
    }
    
    .milestone-card:hover .startup-name, 
    .milestone-card:hover .date-display {
        transform: translateX(5px);
        color: #fff !important;
    }
    
    .pagination {
        --bs-pagination-bg: rgba(255, 255, 255, 0.1);
        --bs-pagination-border-color: rgba(255, 255, 255, 0.2);
        --bs-pagination-color: #fff;
        --bs-pagination-hover-bg: rgba(255, 255, 255, 0.2);
        --bs-pagination-hover-color: #fff;
        --bs-pagination-focus-bg: rgba(255, 255, 255, 0.2);
        --bs-pagination-focus-color: #fff;
        --bs-pagination-active-bg: rgba(13, 110, 253, 0.5);
        --bs-pagination-active-border-color: rgba(255, 255, 255, 0.2);
    }
</style>
@endsection 